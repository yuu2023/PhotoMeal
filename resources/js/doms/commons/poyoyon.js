'use strict';

class Poyoyon {
    #knife = document.getElementById('knife');
    #fork = document.getElementById('fork');

    run() {
        this.#load();
    }

    // ページロード時の処理。
    #load() {
        window.addEventListener('load', function() {
            if(window.sessionStorage.getItem(['not-first']) === null) {
                window.sessionStorage.setItem(['not-first'],['true']);
                this.#knife.classList.add('c-animation-poyoyon');
                this.#fork.classList.add('c-animation-poyoyon');
            }
        }.bind(this));
    }
} export default Poyoyon;
