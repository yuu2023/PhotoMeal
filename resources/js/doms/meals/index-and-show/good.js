'use strict';

class Good {
    #good_parents = document.querySelectorAll('.j-good-parent');

    run() {
        this.#click();
    }

    #click() {
        for(let i = 0; i < this.#good_parents.length; i++) {
            let mealId;
            let goodElement;
            let goodingElement;
            let numElement;

            for(let j = 0; j < this.#good_parents[i].childElementCount; j++) {
                if(this.#good_parents[i].children[j].classList.contains('j-good-parent__meal-id')) {
                    mealId = this.#good_parents[i].children[j].value;
                    continue;
                }

                if(this.#good_parents[i].children[j].classList.contains('j-good-parent__good')) {
                    goodElement = this.#good_parents[i].children[j];
                    continue;
                }

                if(this.#good_parents[i].children[j].classList.contains('j-good-parent__gooding')) {
                    goodingElement = this.#good_parents[i].children[j];
                    continue;
                }

                if(this.#good_parents[i].children[j].classList.contains('j-good-parent__num')) {
                    numElement = this.#good_parents[i].children[j];
                    continue;
                }
            }

            goodElement.addEventListener('click', function() {
                fetch('/mealGood', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        meal_id: mealId,
                    }),
                })
                    .then(response => response.json())
                    .then(result => {
                        numElement.textContent = result.good_num;
                        goodElement.style.display = 'none';
                        goodingElement.style.display = 'block';
                        const messageElement = document.createElement('div');
                        messageElement.textContent = 'いいね！しました。';
                        messageElement.classList.add('c-message');
                        const mainElement = document.getElementById('main');
                        mainElement.appendChild(messageElement);
                    })
                    .catch(error => {
                        //console.log(error);
                    });
            }.bind(this));

            goodingElement.addEventListener('click', function() {
                fetch('/mealGood', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        meal_id: mealId,
                    }),
                })
                    .then(response => response.json())
                    .then(result => {
                        numElement.textContent = result.good_num;
                        goodElement.style.display = 'block';
                        goodingElement.style.display = 'none';
                        const messageElement = document.createElement('div');
                        messageElement.textContent = 'いいね！を解除しました。';
                        messageElement.classList.add('c-message');
                        const mainElement = document.getElementById('main');
                        mainElement.appendChild(messageElement);
                    })
                    .catch(error => {
                        //console.log(error);
                    });
            }.bind(this));
        }
    }
} export default Good;
