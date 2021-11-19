/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

// importation de noUiSlider
import noUiSlider from 'nouislider';
import 'nouislider/dist/nouislider.css';

import Filter from './modules/Filter';

new Filter(document.querySelector('.js-filter'));

const slider = document.getElementById('price-slider');

if(slider) {
    
    const minPrice = document.getElementById('minPrice');
    const maxPrice = document.getElementById('maxPrice');

    const minValue = Math.floor(parseInt(slider.dataset.min, 10) / 10) * 10;
    const maxValue = Math.ceil(parseInt(slider.dataset.max, 10) / 10) * 10;

    const range = noUiSlider.create(slider, {
        start: [minPrice.value || minValue, maxPrice.value || maxValue],
        connect: true,
        step: 500,
        range: {
            'min': minValue,
            'max': maxValue
        }
    });

    range.on('slide', function(values, handle) {
        if (handle === 0){
            minPrice.value = Math.round(values[0]);
        }
        if (handle === 1){
            maxPrice.value = Math.round(values[1]);
        }
    });
    range.on('end', function(values, handle){
        minPrice.dispatchEvent(new Event('change'))
    })
}


 