'use strict';

import Image from "../../../services/image";

class Icon {
    #icon__body__create = document.getElementById('icon__body__create');
    #icon__body__img = document.getElementById('icon__body__img');
    #icon__input = document.getElementById('icon__input');
    #icon__changeFlag = document.getElementById('icon__change-flag');
    #icon__jsError = document.getElementById('icon__js-error');
    #icon__label1 = document.getElementById('icon__label1');
    #icon__label2 = document.getElementById('icon__label2');

    run() {
        this.#load();
        this.#change();
        this.#click()
    }

    // ページロード時の処理。
    #load() {
        window.addEventListener('load', function() {
            if(this.#icon__body__img.src !== "") {
                this.#icon__body__create.style.display = 'none';
                this.#icon__body__img.style.display = 'block';
            }

            // 戻る進むボタンが押されたときの対処
            this.#display();
        }.bind(this));
    }

    // 画像変更時の処理。
    #change() {
        this.#icon__input.addEventListener('change', function() {
            this.#icon__changeFlag.value = '1';
            this.#display();
        }.bind(this));
    }

    #click() {
        this.#icon__label1.onclick = function() {
            this.#icon__input.value = '';
            this.#icon__changeFlag.value = '1';
            this.#display();
        }.bind(this);

        this.#icon__label2.onclick = function() {
            this.#icon__input.value = '';
            this.#icon__changeFlag.value = '1';
            this.#display();
        }.bind(this);
    }

    #initialize() {
        this.#icon__input.value = '';
        this.#icon__changeFlag.value = '1';
        this.#display();
    }

    #display() {
        const file = this.#icon__input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const result = e.target.result;
            const image = new Image();
            const isImage = image.isImage(result);

            if(isImage) {
                this.#icon__body__img.src = image.createLocalURL(file);
                this.#icon__body__create.style.display = 'none';
                this.#icon__body__img.style.display = 'block';
                this.#icon__jsError.style.display = 'none';
            } else {
                this.#icon__input.value = "";
                this.#icon__body__create.style.display = 'flex';
                this.#icon__body__img.style.display = 'none';
                this.#icon__jsError.style.display = 'block';
            }
        }.bind(this);

        if(file !== undefined) {
            reader.readAsArrayBuffer(file);
        } else if(this.#icon__changeFlag.value === '1') {
            this.#icon__input.value = "";
            this.#icon__body__create.style.display = 'flex';
            this.#icon__body__img.style.display = 'none';
            this.#icon__jsError.style.display = 'none';
        }
    }
} export default Icon;
