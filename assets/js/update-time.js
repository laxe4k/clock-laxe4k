let timezone = 'UTC';
let serverOffset = 0;
let basePerfTime = 0;
let baseServerTime = 0;

const baseUrl = 'https://clock.laxe4k.com';

function buildUrl(base, params) {
    const query = new URLSearchParams(params);
    return `${base}?${query.toString()}`;
}

async function getServerTime() {
    try {
        const startPerf = performance.now();
        const startDate = Date.now();

        const urlTimezone = getQueryParam('timezone');
        if (urlTimezone) {
            timezone = urlTimezone;
        }

        const commonParams = {};
        if (urlTimezone) commonParams.timezone = urlTimezone;

        const tzUrl = buildUrl(baseUrl, { ...commonParams, format: 'txt' });
        const timeUrl = buildUrl(baseUrl, { ...commonParams, format: 'json' });

        console.log('Fetching URLs:', { tzUrl, timeUrl });

        const [tzRes, timeRes] = await Promise.all([
            fetch(tzUrl).catch(err => {
                console.error('Failed to fetch tzUrl:', err);
                return null;
            }),
            fetch(timeUrl).catch(err => {
                console.error('Failed to fetch timeUrl:', err);
                return null;
            })
        ]);

        if (!tzRes || !tzRes.ok) {
            const errorBody = await tzRes?.text();
            console.error(`tzUrl failed with status: ${tzRes?.status}, response: ${errorBody}`);
            timezone = Intl.DateTimeFormat().resolvedOptions().timeZone || 'UTC';
        } else {
            const tzText = await tzRes.text();
            timezone = (tzText && tzText !== 'UTC') ? tzText.trim() : Intl.DateTimeFormat().resolvedOptions().timeZone;
        }

        let data;
        if (timeRes && timeRes.ok) {
            try {
                data = await timeRes.json();
            } catch (jsonError) {
                console.warn('timeUrl JSON invalide, fallback local');
            }
        }

        const endPerf = performance.now();
        const latency = (endPerf - startPerf) / 2;

        if (data && data.serverTime) {
            const serverTime = new Date(data.serverTime);
            if (!isNaN(serverTime.getTime())) {
                basePerfTime = performance.now();
                baseServerTime = serverTime.getTime() + latency;
                serverOffset = baseServerTime - startDate;
                return;
            } else {
                console.warn('serverTime invalide, fallback local');
            }
        } else {
            console.warn('Donnée "serverTime" absente, fallback sur Date.now()');
        }

        // Fallback si serverTime manquant ou invalide
        basePerfTime = performance.now();
        baseServerTime = Date.now();
        serverOffset = 0;

    } catch (err) {
        console.error('getServerTime →', err);
        timezone = getQueryParam('timezone') || Intl.DateTimeFormat().resolvedOptions().timeZone || 'UTC';
        basePerfTime = performance.now();
        baseServerTime = Date.now();
        serverOffset = 0;
    }
}

function getPreciseTime() {
    const nowPerf = performance.now();
    const elapsed = nowPerf - basePerfTime;
    return new Date(baseServerTime + elapsed); // UTC
}

function updateTime() {
    const preciseDateUTC = getPreciseTime();

    const formatter = new Intl.DateTimeFormat('fr-BE', {
        timeZone: timezone,
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false,
    });

    const parts = formatter.formatToParts(preciseDateUTC);
    const timeParts = {};
    for (const part of parts) {
        if (part.type !== 'literal') {
            timeParts[part.type] = part.value;
        }
    }

    const heure = timeParts.hour?.padStart(2, '0') ?? '--';
    const minute = timeParts.minute?.padStart(2, '0') ?? '--';
    const seconde = timeParts.second?.padStart(2, '0') ?? '--';

    const digits = [
        'bcdigit1', 'bcdigit2', 'bcdigit3',
        'bcdigit4', 'bcdigit5', 'bcdigit6'
    ].map(id => document.getElementById(id));

    const newValues = [...heure, ...minute, ...seconde];
    digits.forEach((digit, i) => {
        if (digit && digit.innerText !== newValues[i]) {
            digit.innerText = newValues[i];
        }
    });

    const title = document.querySelector('title');
    if (title) {
        // Met à jour le titre seulement quand les minutes changent
        if (!title.dataset.prevMinute || title.dataset.prevMinute !== minute) {
            title.textContent = `${title.textContent.split('|')[0].trim()} | ${heure}:${minute}`;
            title.dataset.prevMinute = minute;
        }
    }
}

function startTicking() {
    let previousSec = null;

    function tick() {
        const now = getPreciseTime();
        const sec = now.getSeconds();
        if (sec !== previousSec) {
            previousSec = sec;
            updateTime();
        }
        requestAnimationFrame(tick);
    }

    requestAnimationFrame(tick);
}

function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

(async function initialize() {
    await getServerTime();
    updateTime();
    startTicking();
})();
