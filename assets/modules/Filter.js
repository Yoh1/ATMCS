/**
 * @property {HTMLElement} pagination
 * @property {HTMLElement} content
 * @property {HTMLElement} sorting
 * @property {HTMLFormElement} form
 */
export default class Filter {


    /**
     * @param {HTMLElement|null} element 
     */
    constructor (element){
        if(element === null){
            return
        }
        this.pagination = element.querySelector('.js-filter-pagination');
        this.content = element.querySelector('.js-filter-content');
        this.sorting = element.querySelector('.js-filter-sorting');
        this.form = element.querySelector('.js-filter-form');
        this.models = element.querySelector('.js-filter-models');

        this.bindEvents();
    }

    /**
     * Ajoute les comportements aux différens éléments
     */
    bindEvents() {
        const aClickListener = e => {
            if(e.target.tagName === 'A') {
                e.preventDefault();
                this.loadURL(e.target.getAttribute('href'));
            }
        }
        this.sorting.addEventListener('click', aClickListener)
        this.pagination.addEventListener('click', aClickListener)
        this.form.querySelectorAll('input').forEach(input => {
            input.addEventListener('change', this.loadForm.bind(this))
        })
    }

    async loadForm() {
        const data = new FormData(this.form);
        const url = new URL(this.form.getAttribute('action') || window.location.href);
        const params = new URLSearchParams();
        data.forEach((value, key) => {
            params.append(key, value)
        })
        return this.loadURL(url.pathname + '?' + params.toString())
    }

    async loadURL(url) {
        this.showLoader();
        
        const params = new URLSearchParams(url.split('?')[1] || '');
        params.set('ajax', 1);
        //const ajaxURL = url + '&ajax=1';
        const response = await fetch(url.split('?')[0] + '?' + params.toString(), {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        if(response.status >= 200 && response.status < 300){
            const data = await response.json();
            this.content.innerHTML = data.content;
            this.sorting.innerHTML = data.sorting;
            this.pagination.innerHTML = data.pagination;
            //this.models.innerHTML = data.models;
            params.delete('ajax');
            this.updatePrices(data);
            history.replaceState({}, '', url.split('?')[0] + '?' + params.toString());
            // voir mettre pushShate au lieu de replaceState
        } else {
            console.error(response);
        }
        this.hideLoader();
    }

    showLoader(){
        this.form.classList.add('is-loading');
        const loader = this.form.querySelector('.js-loading');
        if (loader === null) {
            return
        }
        loader.setAttribute('aria-hiddent', 'false');
        loader.style.display = null;
    }

    hideLoader(){
        this.form.classList.remove('is-loading');
        const loader = this.form.querySelector('.js-loading');
        if (loader === null) {
            return
        }
        loader.setAttribute('aria-hiddent', 'true');
        loader.style.display = 'none';
        /*this.form.querySelectorAll('input').forEach(input => {
                input.addEventListener('change', this.loadForm.bind(this))
        });*/
    }

    updatePrices ({min, max}) {
        const slider = document.getElementById('price-slider');
        if(slider === null){
            return
        }
        slider.noUiSlider.updateOptions({
            range: {
                min: [min],
                max: [max]
            }
        })
    }
}