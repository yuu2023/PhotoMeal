'use strict';

class Shop {
    #shop__input = document.getElementById('create-and-edit-modal__form__shop__input');
    #shop__search__outer__label__img = document.getElementById('create-and-edit-modal__form__shop__search__outer__label__img');
    #shop__search__outer__input = document.getElementById('create-and-edit-modal__form__shop__search__outer__input');
    #shop__notRegister__label__checkbox = document.getElementById('create-and-edit-modal__form__shop__not-register__label__checkbox');
    #shop__notRegister__caution = document.getElementById('create-and-edit-modal__form__shop__not-register__caution');
    #shop__oldShopName = document.getElementById('create-and-edit-modal__form__shop__old-shop-name');

    run() {
        this.#load();
        this.#search();
        this.#changeCheckBox();
    }

    // ページロード時の処理。
    #load() {
        window.addEventListener('load', function() {
            this.#toggleDisabled();
        }.bind(this));
    }

    // 活動地域検索時の処理。検索ボックスの値から活動地域を取得し、セレクトボックスに表示する。
    #search() {
        // this.#shop__search__outer__input.addEventListener('keyup', function() {
        this.#shop__search__outer__input.addEventListener('change', function() {
            fetch('/hotpepper/getShopsByWord', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    word: this.#shop__search__outer__input.value,
                }),
            })
                .then(response => response.json())
                .then(result => {
                    while (this.#shop__input.firstChild) {
                        this.#shop__input.removeChild(this.#shop__input.firstChild);
                    }

                    let isFirst = true;
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

    // 確定。バリデーションエラー時のために、選択中のショップ名をキープする。
    #submit() {
        // this.#shop__input.addEventListener('input', function() {
        //     this.#shop__oldShopName.value = this.#shop__input.options[this.#shop__input.selectedIndex].text;
        //     console.log(this.#shop__input.options[this.#shop__input.selectedIndex].text);
        // }.bind(this));
    }

    // チェックボックスの状態が変わったときの処理。
    #changeCheckBox() {
        this.#shop__notRegister__label__checkbox.addEventListener('change', function() {
            this.#toggleDisabled();
        }.bind(this));
    }

    // チェックボックスの状態によって、店舗のinputエレメントが入力可能か切り替える。
    #toggleDisabled() {
        if(this.#shop__notRegister__label__checkbox.checked) {
            this.#shop__input.disabled = true;
            this.#shop__oldShopName.disabled = true;
            this.#shop__search__outer__input.disabled = true;
            this.#shop__notRegister__caution.style.display = 'block';
            this.#shop__search__outer__label__img.style.cursor = 'default';
            this.#shop__search__outer__label__img.style.opacity = 0.7;
        } else {
            this.#shop__input.disabled = false;
            this.#shop__oldShopName.disabled = false;
            this.#shop__search__outer__input.disabled = false;
            this.#shop__notRegister__caution.style.display = 'none';
            this.#shop__search__outer__label__img.style.cursor = 'pointer';
            this.#shop__search__outer__label__img.style.opacity = 1;
        }
    }
} export default Shop;
