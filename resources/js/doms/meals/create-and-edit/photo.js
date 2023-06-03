'use strict';

import Image from "../../../services/image";

class Photo {
    #photo__body__create = document.getElementById('create-and-edit-modal__form__photo__body__create');
    #photo__body__img = document.getElementById('create-and-edit-modal__form__photo__body__img');
    #photo__input = document.getElementById('create-and-edit-modal__form__photo__input');
    #photo__changeFlag = document.getElementById('create-and-edit-modal__form__photo__change-flag');
    #photo__jsError = document.getElementById('create-and-edit-modal__form__photo__js-error');
    #shop__input = document.getElementById('create-and-edit-modal__form__shop__input');
    #photo__label1 = document.getElementById('create-and-edit-modal__form__photo__label1');
    #photo__label2 = document.getElementById('create-and-edit-modal__form__photo__label2');

    run() {
        this.#load();
        this.#change();
        this.#click();
    }

    // ページロード時の処理。
    #load() {
        window.addEventListener('load', function() {
            if(this.#photo__body__img.src !== "") {
                this.#photo__body__create.style.display = 'none';
                this.#photo__body__img.style.display = 'block';
            }

            // 戻る進むボタンが押されたときの対処
            this.#display();
        }.bind(this));
    }

    // 画像変更時の処理。
    #change() {
        this.#photo__input.addEventListener('change', function() {
            this.#photo__changeFlag.value = '1';
            this.#display();
            this.#processExif();
        }.bind(this));
    }

    #click() {
        this.#photo__label1.onclick = function() {
            this.#photo__input.value = '';
            this.#photo__changeFlag.value = '1';
            this.#display();
            this.#processExif();
        }.bind(this);

        this.#photo__label2.onclick = function() {
            this.#photo__input.value = '';
            this.#photo__changeFlag.value = '1';
            this.#display();
            this.#processExif();
        }.bind(this);
    }

    #display() {
        const file = this.#photo__input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const result = e.target.result;
            const image = new Image();
            const isImage = image.isImage(result);

            if(isImage) {
                this.#photo__body__img.src = image.createLocalURL(file);
                this.#photo__body__create.style.display = 'none';
                this.#photo__body__img.style.display = 'block';
                this.#photo__jsError.style.display = 'none';
            } else {
                this.#photo__input.value = "";
                this.#photo__body__create.style.display = 'flex';
                this.#photo__body__img.style.display = 'none';
                this.#photo__jsError.style.display = 'block';
            }
        }.bind(this);

        if(file !== undefined) {
            reader.readAsArrayBuffer(file);
        } else if(this.#photo__changeFlag.value === '1') {
            this.#photo__input.value = "";
            this.#photo__body__create.style.display = 'flex';
            this.#photo__body__img.style.display = 'none';
            this.#photo__jsError.style.display = 'none';
        }
    }

    // 写真のEXIF情報から店の候補を表示する。
    #processExif() {
        if(this.#photo__input.files[0] === undefined) {
            // 画像がないとき
            while (this.#shop__input.firstChild) {
                this.#shop__input.removeChild(this.#shop__input.firstChild);
            }
            return;
        }

        EXIF.getData(this.#photo__input.files[0], function() {
            const GPSLatitude = EXIF.getTag(this.#photo__input.files[0], "GPSLatitude");
            const GPSLongitude = EXIF.getTag(this.#photo__input.files[0], "GPSLongitude");

            if(GPSLatitude === undefined || GPSLongitude === undefined) {
                // GPS情報がないとき
                while (this.#shop__input.firstChild) {
                    this.#shop__input.removeChild(this.#shop__input.firstChild);
                }
                return;
            }

            const latitude =
                GPSLatitude[0]['numerator'] / GPSLatitude[0]['denominator'] +
                GPSLatitude[1]['numerator'] / GPSLatitude[1]['denominator'] / 60 +
                GPSLatitude[2]['numerator'] / GPSLatitude[2]['denominator'] / 3600
            const longitude =
                GPSLongitude[0]['numerator'] / GPSLongitude[0]['denominator'] +
                GPSLongitude[1]['numerator'] / GPSLongitude[1]['denominator'] / 60 +
                GPSLongitude[2]['numerator'] / GPSLongitude[2]['denominator'] / 3600

                fetch('/hotpepper/getShopsByCoords', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        latitude: latitude,
                        longitude: longitude,
                    }),
                })
                    .then(response => response.json())
                    .then(result => {
                        while (this.#shop__input.firstChild) {
                            this.#shop__input.removeChild(this.#shop__input.firstChild);
                        }
                        result.shops.forEach(function(value, index) {
                            const optionElement = document.createElement('option');
                            const content = document.createTextNode(value.name);
                            optionElement.appendChild(content);
                            optionElement.setAttribute('value', value.id);
                            if(index === 0) {
                                optionElement.setAttribute('selected', true);
                            }
                            this.#shop__input.appendChild(optionElement, this.#shop__input.firstChild);
                        }.bind(this));
                    })
                    .catch(error => {
                        //console.log(error);
                    });
        }.bind(this));
    }
} export default Photo;
