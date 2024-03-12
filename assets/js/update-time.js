// prendre les valeurs de l'heure, des minutes et des secondes et incrémenter les secondes
setInterval(function(){
    var title = document.querySelector('title');
    var fuseau = document.getElementById('timezone').value;
    var heureElement = document.getElementById('heure');
    var minuteElement = document.getElementById('minute');
    var secondeElement = document.getElementById('seconde');

    var date = new Date().toLocaleString("en-US", {timeZone: fuseau});
    date = new Date(date);

    var heure = String(date.getHours()).padStart(2, '0');
    var minute = String(date.getMinutes()).padStart(2, '0');
    var seconde = String(date.getSeconds()).padStart(2, '0');

    heureElement.innerHTML = heure;
    minuteElement.innerHTML = minute;
    secondeElement.innerHTML = seconde;

    var heureformated = formatTime(heure, minute, seconde);
    title.textContent = formatTitle(title.textContent, heureformated);
}, 1000);

function formatTime(heure, minute, seconde) {
    return heure + ':' + minute + ':' + seconde;
}

function formatTitle(titleText, heureformated) {
    return titleText.split('|')[0] + ' | ' + heureformated;
}
