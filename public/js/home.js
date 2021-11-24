

setInterval(dispHeur, 1000);

function dispHeur() {
    let toDayHour = new Date().toLocaleString('fr-Fr', {

        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
    });
    document.getElementById('p1').innerHTML = toDayHour;
}