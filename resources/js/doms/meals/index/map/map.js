'use strict';

class Map {
    #map__meals = document.querySelectorAll('.j-map__meal');

    run() {
        this.#loadCss();
        const map = this.#createMap();
        this.#addMarker(map);
    }

    #loadCss() {
        var link = document.createElement("link");
        link.rel = "stylesheet";
        link.href = "https://unpkg.com/leaflet@1.9.4/dist/leaflet.css";
        link.type = "text/css"
        document.getElementsByTagName('head')[0].appendChild(link);
    }

    #createMap() {
        let map;
        if(this.#map__meals.length === 0) {
            map = L.map('map', {
                center: [35.6894, 139.6917],
                zoom: 13
            });
        } else {
            map = L.map('map');
        }

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        return map;
    }

    #addMarker(map) {
        if(this.#map__meals.length === 0) {
            return;
        }

        const meals = [];
        const iconWidth = 40;
        const iconHeight = 40;

        for(let i = 0; i < this.#map__meals.length; i++) {
            let title;
            let img;
            let latitude;
            let longitude;
            let link;

            for(let j = 0; j < this.#map__meals[i].childElementCount; j++) {
                if(this.#map__meals[i].children[j].classList.contains('j-map__meal__title')) {
                    title = this.#map__meals[i].children[j].value;
                    continue;
                }

                if(this.#map__meals[i].children[j].classList.contains('j-map__meal__img')) {
                    img = this.#map__meals[i].children[j].value;
                    continue;
                }

                if(this.#map__meals[i].children[j].classList.contains('j-map__meal__latitude')) {
                    latitude = this.#map__meals[i].children[j].value;
                    continue;
                }

                if(this.#map__meals[i].children[j].classList.contains('j-map__meal__longitude')) {
                    longitude = this.#map__meals[i].children[j].value;
                    continue;
                }

                if(this.#map__meals[i].children[j].classList.contains('j-map__meal__link')) {
                    link = this.#map__meals[i].children[j].value;
                    continue;
                }
            }

            const meal = new Meal(title, img, latitude, longitude, link);
            let equalFlag = false;

            for(let k = 0; k < meals.length; k++) {
                if(meal.isEqualCoords(meals[k][0])) {
                    meals[k].push(meal);
                    equalFlag = true;
                    break;
                }
            }

            if(!equalFlag) {
                meals.push([meal]);
            }
        }

        const iconMarkers = L.featureGroup();

        for(let i = 0; i < meals.length; i++) {
            if(meals[i].length === 1) {
                const myIcon = L.icon({
                    iconUrl: meals[i][0].img,
                    iconSize: [iconWidth, iconHeight],
                });

                const marker = L.marker([meals[i][0].latitude, meals[i][0].longitude], {
                    icon: myIcon,
                    title: meals[i][0].title,
                    riseOnHover: true,
                    autoPanOnFocus: false
                }).on('click', function() {
                    window.location.href = meals[i][0].link;
                });

                iconMarkers.addLayer(marker);
            } else {
                const mealNum = meals[i].length
                const myIcon = L.icon({
                    iconUrl: './storage/images/parts/' + mealNum + '.svg',
                    iconSize: [iconWidth, iconHeight],
                });

                let code = '';
                let flexWidth;
                if(meals[i].length === 1) {
                    flexWidth = iconWidth;
                } else if(meals[i].length === 2) {
                    flexWidth = iconWidth * 2;
                } else {
                    flexWidth = iconWidth * 3;
                }

                for(let j = 0; j < meals[i].length; j++) {
                    if(j % 3 === 0) {
                        code += '<div style="display: flex; width: ' + flexWidth + 'px;">';
                    }
                    code += '<a href="' + meals[i][j].link + '"><img src="' + meals[i][j].img + '" alt="料理" title="' + meals[i][j].title + '" style="width: ' + iconWidth + 'px; height: ' + iconHeight + 'px; object-fit: cover;"></a>';
                    if(j % 3 === 2) {
                        code += '</div>';
                    }
                }

                if(meals[i].length % 3 !== 0) {
                    code += '</div>';
                }

                const popup = L.popup({
                    content: code,
                    closeButton: false
                });

                const marker = L.marker([meals[i][0].latitude, meals[i][0].longitude], {
                    icon: myIcon,
                    riseOnHover: true,
                    autoPanOnFocus: false
                }).bindPopup(popup);

                iconMarkers.addLayer(marker);
            }
        }

        iconMarkers.addTo(map);
        map.fitBounds(iconMarkers.getBounds());
    }
} export default Map;

class Meal {
    constructor(title, img, latitude, longitude, link) {
        this.title = title;
        this.img = img;
        this.latitude = latitude;
        this.longitude = longitude;
        this.link = link;
    }

    isEqualCoords(meal) {
        if(this.latitude === meal.latitude && this.longitude === meal.longitude) {
            return true;
        }
        return false;
    }
}
