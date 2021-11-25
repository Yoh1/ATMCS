
let listInputs = document.querySelectorAll('input');
let btn = document.getElementById('sub');
let year = document.getElementById('form_year');



// document.querySelector("form").addEventListener("submit", formValid)
// document.formulaire.addEventListener('submit', formValid);

// console.log(document.querySelector("form"));

btn.addEventListener('click', formValid);

function formValid() {

    // e.preventDefault();
    for (input of listInputs) {

        let p1 = document.createElement('p');
        p1.style.color = 'red'
        p1.style.fontWeight = 'bold'
        input.parentElement.append(p1)

        // input = false;
        // inputElement.parentNode.lastElementChild.innerText = "";

        if ((input.value) == "") {
            p1.innerHTML = 'Veuillez remplire le champs vide';

        }
        console.log(year.value.length);

        if (year.value.length != 4) {
            year.parentNode.lastChild.innerHTML = 'Veuillez mettre au minimum et au maximum 4 chiffres';
        }
    }

}