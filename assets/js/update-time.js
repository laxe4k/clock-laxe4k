let timezone = 'UTC';
let serverOffset = 0;
let basePerfTime = 0;
let baseServerTime = 0;

async function getServerTime() {
    try {
        const startPerf = performance.now();
        const startDate = Date.now();

        // Récupération combinée du fuseau horaire et de l'heure
        const [tzRes, timeRes] = await Promise.all([
            fetch('?format=txt').catch(() => null),
            fetch('?format=json').catch(() => null)
        ]);

        if (!tzRes || !tzRes.ok || !timeRes || !timeRes.ok) throw new Error('Erreur lors de la récupération des données serveur');

        const tzText = await tzRes.text();
        timezone = (tzText && tzText !== 'UTC') ? tzText.trim() : Intl.DateTimeFormat().resolvedOptions().timeZone;
        console.log('Fuseau horaire du serveur :', timezone);

        let data;
        try {
            data = await timeRes.json();
        } catch (e) {
            throw new Error('Réponse JSON invalide');
        }
        if (!data || !data.serverTime) throw new Error('Donnée "serverTime" manquante');

        const serverTime = new Date(data.serverTime);
        if (isNaN(serverTime.getTime())) {
            throw new Error('Donnée "serverTime" invalide');
        }

        const endPerf = performance.now();
        const latency = (endPerf - startPerf) / 2;
        console.log('Latence calculée (ms) :', latency);

        basePerfTime = performance.now();
        baseServerTime = serverTime.getTime() + latency;
        console.log('Base Server Time (ms) :', baseServerTime);

        serverOffset = baseServerTime - startDate;
        console.log('Décalage serveur (ms) :', serverOffset);
    } catch (err) {
        console.error('getServerTime →', err);
        timezone = Intl.DateTimeFormat().resolvedOptions().timeZone || 'UTC';
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

    // Formatage de la date dans le fuseau horaire réel
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
        title.textContent = `${title.textContent.split('|')[0].trim()} | ${heure}:${minute}`;
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

(async function initialize() {
    await getServerTime();
    updateTime();
    startTicking();
})();
