'use strict';

class Area {
    #area__input = document.getElementById('area__input');
    #area__search__outer__label__img = document.getElementById('area__search__outer__label__img');
    #area__search__outer__input = document.getElementById('area__search__outer__input');
    #area__notRegister__label__checkbox = document.getElementById('area__not-register__label__checkbox');
    #area__visibility__input = document.getElementById('area__visibility__input');
    #area__notRegister__caution = document.getElementById('area__not-register__caution');

    run() {
        this.#load();
        this.#search();
        this.#changeCheckBox();
    }

    // ページロード時の処理。チェックボックスの状態によって、活動地域のinputエレメントが入力可能か切り替える。また、GPS情報から活動地域を取得し、セレクトボックスに表示する。
    #load() {
        window.addEventListener('load', function() {
            this.#toggleDisabled();

            if(this.#area__input.childElementCount !== 0) {
                return;
            }

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    fetch('/yolp/getAreaByCoords', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude,
                        }),
                    })
                        .then(response => response.json())
                        .then(result => {
                            const optionElement = document.createElement('option');
                            const content = document.createTextNode(result.area);
                            optionElement.appendChild(content);
                            optionElement.setAttribute('value', result.area);
                            optionElement.setAttribute('selected', true);
                            this.#area__input.insertBefore(optionElement, this.#area__input.firstChild);
                        })
                        .catch(error => {
                            //console.log(error);
                        });
                },
                (error) => {
                    //console.log(error);
                }
            );
        }.bind(this));
    }

    // 活動地域検索時の処理。検索ボックスの値から活動地域を取得し、セレクトボックスに表示する。
    #search() {
        // this.#area__search__outer__input.addEventListener('keyup', function() {
        this.#area__search__outer__input.addEventListener('change', function() {
            fetch('/yolp/getAreasByWord', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    word: this.#area__search__outer__input.value,
                }),
            })
                .then(response => response.json())
                .then(result => {
                    while (this.#area__input.firstChild) {
                        this.#area__input.removeChild(this.#area__input.firstChild);
                    }

                    let isFirst = true;
                    result.areas.forEach(function(area){
                        const optionElement = document.createElement('option');
                        const content = document.createTextNode(area);
                        optionElement.appendChild(content);
                        optionElement.setAttribute('value', area);
                        if(isFirst) {
                            optionElement.setAttribute('selected', true);
                            isFirst = false;
                        }
                        this.#area__input.appendChild(optionElement, this.#area__input.firstChild);
                    }.bind(this));
                })
                .catch(error => {
                    //console.log(error);
                });
        }.bind(this));
    }

    // チェックボックスの状態が変わったときの処理。
    #changeCheckBox() {
        this.#area__notRegister__label__checkbox.addEventListener('change', function() {
            this.#toggleDisabled();
        }.bind(this));
    }

    // チェックボックスの状態によって、活動地域のinputエレメントが入力可能か切り替える。
    #toggleDisabled() {
        if(this.#area__notRegister__label__checkbox.checked) {
            this.#area__input.disabled = true;
            this.#area__search__outer__input.disabled = true;
            this.#area__visibility__input.disabled = true;
            this.#area__notRegister__caution.style.display = 'block';
            this.#area__search__outer__label__img.style.cursor = 'default';
            this.#area__search__outer__label__img.style.opacity = 0.7;
        } else {
            this.#area__input.disabled = false;
            this.#area__search__outer__input.disabled = false;
            this.#area__visibility__input.disabled = false;
            this.#area__notRegister__caution.style.display = 'none';
            this.#area__search__outer__label__img.style.cursor = 'pointer';
            this.#area__search__outer__label__img.style.opacity = 1;
        }
    }

} export default Area;
