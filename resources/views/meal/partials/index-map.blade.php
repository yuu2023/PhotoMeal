<div class="p-meal-index-map">
    <div class="p-meal-index-map__map" id="map"></div>
    @foreach($meals as $meal)
        @if(!empty($meal->shop_id) && !empty($meal->shop->latitude) && !empty($meal->shop->longitude))
            <div class="j-map__meal">
                <input type="hidden" class="j-map__meal__title" value="{{ $meal->title }}">
                <input type="hidden" class="j-map__meal__img" value="{{ asset('storage/images/meals/'.$meal->photo) }}">
                <input type="hidden" class="j-map__meal__latitude" value="{{ $meal->shop->latitude }}">
                <input type="hidden" class="j-map__meal__longitude" value="{{ $meal->shop->longitude }}">
                <input type="hidden" class="j-map__meal__link" value="{{route('meal.show', $meal)}}">
            </div>
        @endif
    @endforeach
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@vite(['resources/js/doms/meals/index/map/script.js'])
