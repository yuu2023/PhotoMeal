'use strict';

class Mode {
    #form = document.getElementById('form');
    #modeAndCreate__mode__grid = document.getElementById('mode-and-create__mode__grid');
    #modeAndCreate__mode__detail = document.getElementById('mode-and-create__mode__detail');
    #modeAndCreate__mode__map = document.getElementById('mode-and-create__mode__map');
    #form__mode = document.getElementById('form__mode');
    #form__pageTemp = document.getElementById('form__page-temp');
    #form__page = document.getElementById('form__page');

    run() {
        this.#click();
    }

    #click() {
        this.#modeAndCreate__mode__grid.addEventListener('click', function() {
            this.#form__mode.value = 'grid';
            if(this.#form__pageTemp.value !== '') {
                this.#form__page.value = this.#form__pageTemp.value;
            }
            this.#form.submit();
        }.bind(this));

        this.#modeAndCreate__mode__detail.addEventListener('click', function() {
            this.#form__mode.value = 'detail';
            if(this.#form__pageTemp.value !== '') {
                this.#form__page.value = this.#form__pageTemp.value;
            }
            this.#form.submit();
        }.bind(this));

        this.#modeAndCreate__mode__map.addEventListener('click', function() {
            this.#form__mode.value = 'map';
            if(this.#form__pageTemp.value !== '') {
                this.#form__page.value = this.#form__pageTemp.value;
            }
            this.#form.submit();
        }.bind(this));
    }

} export default Mode;
