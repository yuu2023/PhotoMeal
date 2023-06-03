'use strict';

class Narrow {
    #form = document.getElementById('form');
    #form__search__input = document.getElementById('form__search__input');
    #form__select__filter__input = document.getElementById('form__select__filter__input');
    #form__select__sort__input = document.getElementById('form__select__sort__input');
    #form__select__filter__input__near = document.getElementById('form__select__filter__input__near');
    #form__select__filter__latitude = document.getElementById('form__select__filter__latitude');
    #form__select__filter__longitude = document.getElementById('form__select__filter__longitude');

    run() {
        this.#load();
        this.#change();
    }

    #load() {
        window.addEventListener('load', function() {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    this.#form__select__filter__latitude.value = position.coords.latitude;
                    this.#form__select__filter__longitude.value = position.coords.longitude;
                },
                (error) => {
                    this.#form__select__filter__input__near.remove();
                }
            );
        }.bind(this));
    }

    #change() {
        this.#form__search__input.addEventListener('change', function() {
            this.#form.submit();
        }.bind(this));

        this.#form__select__filter__input.addEventListener('change', function() {
            this.#form.submit();
        }.bind(this));

        this.#form__select__sort__input.addEventListener('change', function() {
            this.#form.submit();
        }.bind(this));
    }
} export default Narrow;
