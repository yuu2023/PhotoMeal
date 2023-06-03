'use strict';

class Favorite {
    #favorite_parents = document.querySelectorAll('.j-favorite-parent');

    run() {
        this.#click();
    }

    #click() {
        for(let i = 0; i < this.#favorite_parents.length; i++) {
            let mealId;
            let favoriteElement;
            let favoritingElement;
            let numElement;

            for(let j = 0; j < this.#favorite_parents[i].childElementCount; j++) {
                if(this.#favorite_parents[i].children[j].classList.contains('j-favorite-parent__meal-id')) {
                    mealId = this.#favorite_parents[i].children[j].value;
                    continue;
                }

                if(this.#favorite_parents[i].children[j].classList.contains('j-favorite-parent__favorite')) {
                    favoriteElement = this.#favorite_parents[i].children[j];
                    continue;
                }

                if(this.#favorite_parents[i].children[j].classList.contains('j-favorite-parent__favoriting')) {
                    favoritingElement = this.#favorite_parents[i].children[j];
                    continue;
                }

                if(this.#favorite_parents[i].children[j].classList.contains('j-favorite-parent__num')) {
                    numElement = this.#favorite_parents[i].children[j];
                    continue;
                }
            }

            favoriteElement.addEventListener('click', function() {
                fetch('/mealFavorite', {
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
                        numElement.textContent = result.favorite_num;
                        favoriteElement.style.display = 'none';
                        favoritingElement.style.display = 'block';
                        const messageElement = document.createElement('div');
                        messageElement.textContent = 'お気に入りにしました。';
                        messageElement.classList.add('c-message');
                        const mainElement = document.getElementById('main');
                        mainElement.appendChild(messageElement);
                    })
                    .catch(error => {
                        //console.log(error);
                    });
            }.bind(this));

            favoritingElement.addEventListener('click', function() {
                fetch('/mealFavorite', {
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
                        numElement.textContent = result.favorite_num;
                        favoriteElement.style.display = 'block';
                        favoritingElement.style.display = 'none';
                        const messageElement = document.createElement('div');
                        messageElement.textContent = 'お気に入りを解除しました。';
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
} export default Favorite;
