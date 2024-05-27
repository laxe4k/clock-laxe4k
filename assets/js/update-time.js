// prendre les valeurs de l'heure, des minutes et des secondes et incrémenter les secondes
function updateTime() {
    let title = document.querySelector('title');
    let fuseau = document.getElementById('timezone').value;
    let heureElement = document.getElementById('heure');
    let minuteElement = document.getElementById('minute');
    let secondeElement = document.getElementById('seconde');

    let date = new Date().toLocaleString("en-US", { timeZone: fuseau });
    date = new Date(date);

    let heure = String(date.getHours()).padStart(2, '0');
    let minute = String(date.getMinutes()).padStart(2, '0');
    let seconde = String(date.getSeconds()).padStart(2, '0');

    heureElement.innerHTML = heure;
    minuteElement.innerHTML = minute;
    secondeElement.innerHTML = seconde;

    let heureformated = formatTime(heure, minute, seconde);
    title.textContent = formatTitle(title.textContent, heureformated);
}


function formatTime(heure, minute, seconde) {
    return heure + ':' + minute + ':' + seconde;
}

function formatTitle(titleText, heureformated) {
    return titleText.split('|')[0] + ' | ' + heureformated;
}

updateTime();
setInterval(updateTime, 1000);

// quand on clique sur l'element avec la classe 'heure', on affiche ou on cache le header et le footer
let heureElement = document.querySelector('.heure');
heureElement.addEventListener('click', function () {
    let header = document.querySelector('header');
    let footer = document.querySelector('footer');
    let main = document.querySelector('main');

    if (header.style.display === 'none') {
        header.style.display = 'flex';
        footer.style.display = 'block';
        main.style.animation = 'OriginalBackground 0s ease-in-out forwards';
        // sortir de la fenetre en plein écran
        document.exitFullscreen?.() || document.webkitExitFullscreen?.() || document.msExitFullscreen?.();
    } else {
        header.style.display = 'none';
        footer.style.display = 'none';
        // quand l'animlation changeBackground est terminée, le background doit rester en noir
        main.style.animation = 'changeBackground 0.3s ease-in-out forwards';
        // mettre la fenetre en plein écran
        main.requestFullscreen?.() || main.webkitRequestFullscreen?.() || main.msRequestFullscreen?.();
    }
});
