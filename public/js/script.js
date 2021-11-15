


setInterval(dispHeur, 1000);

function dispHeur() {
    let date1 = new Date();

    let dateLocale = date1.toLocaleString('fr-FR', {

        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
    });

    document.getElementById('p1').innerHTML = dateLocale;

}