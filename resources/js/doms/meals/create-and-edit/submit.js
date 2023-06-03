'use strict';

class Submit {
    #buttons__submit = document.getElementById('create-and-edit-modal__form__buttons__submit');
    #shop__input = document.getElementById('create-and-edit-modal__form__shop__input');
    #shop__oldShopName = document.getElementById('create-and-edit-modal__form__shop__old-shop-name');
    #form = document.getElementById('create-and-edit-modal__form');

    run() {
        this.#buttons__submit.addEventListener('click', function() {
            if(this.#shop__input.disabled) {
                this.#shop__oldShopName.value = null;
            }
            else if(this.#shop__input.selectedIndex !== -1) {
                this.#shop__oldShopName.value = this.#shop__input.options[this.#shop__input.selectedIndex].text;
            }
            this.#form.submit();
        }.bind(this));
    }
} export default Submit;
