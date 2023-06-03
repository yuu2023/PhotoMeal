<div class="p-meal-index-grid">
    @foreach($meals as $meal)
        <a class="p-meal-index-grid__link" href="{{route('meal.show', $meal)}}">
            <img class="p-meal-index-grid__link__img" src="{{ asset('storage/images/meals/'.$meal->photo)}}" alt="料理">
        </a>
    @endforeach
</div>
