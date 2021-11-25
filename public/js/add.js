

let listInputs = document.querySelectorAll('input');
listInputs.style = 'color:red';


let btn = document.getElementById('sub');
let year = document.getElementById('form_year');



// let anno = document.getElementById("conteneur");

// if (!anno) {
//     console.log('rien');
// }

// console.log(document);
// console.log(document.querySelector('body'));





// document.querySelector("form").addEventListener("submit", formValid)

// console.log(document.querySelector("form"));


btn.addEventListener('click', formValid);

function formValid() {
    // e.preventDefault();
    for (input of listInputs) {

        let p1 = document.createElement('p');
        // p1.classList.add = 'error'
        p1.style.color = 'red'
        p1.style.fontWeight = 'bold'
        input.parentElement.append(p1)

        // input = false;
        // inputElement.parentNode.lastElementChild.innerText = "";

        if ((input.value) == "") {
            // e.preventDefault();
            p1.innerHTML = 'Veuillez remplire le champs vide';
        }
        // input = false;
        // inputElement.parentNode.lastElementChild.innerText = "";

    }

    if (input.value.length <= 4 || input.value.length >= 4) {

        year.innerHTML = 'Veuillez mettre au minimum et au maximum 4 chiffres';

    }


}