

let listInputs = document.querySelectorAll('input');
listInputs.style = 'color:red';


let btn = document.getElementById('sub');

// let erreur = document.querySelectorAll('error');


// let anno = document.getElementById("conteneur");

// if (!anno) {
//     console.log('rien');
// }

// console.log(document);
// console.log(document.querySelector('body'));




// let ma = document.getElementById("marque");

// let ma = document.getElementById("form_marque");
// ma.style.color = "red";


// let ma = document.getElementById('form_marque');
// let mo = document.getElementById('form_modele');
// let anne = document.getElementById('form_annee');
// let kilo = document.getElementById('form_kolometrage');
// let prix = document.getElementById('form_prix');
// let loca = document.getElementById('form_localisation');
// let da = document.getElementById('form_date');
// let mage = document.getElementById('form_image');

// let btn = document.getElementById('sub');
// let fi = document.getElementById('file');

// erreur.textContent = 'hello';




// document.querySelector("form").addEventListener("submit", formValid)

// console.log(document.querySelector("form"));


btn.addEventListener('click', formValid);

function formValid() {
    console.log('yes !');
    // e.preventDefault();

    // if (listInputs.validity.valueMissing) {
    // erreur.classList.add = '.error'



    for (input of listInputs) {


        let p1 = document.createElement('p');
        p1.classList.add = 'error'
        p1.style.color = 'red'
        p1.style.fontWeight = 'bold'
        input.parentElement.append(p1)


        if ((input.value) == "") {
            // e.preventDefault();
            p1.innerHTML = 'Veuillez remplire le champs vide';
        }


    }
}