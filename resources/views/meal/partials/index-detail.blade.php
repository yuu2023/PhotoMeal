<div class="p-meal-index-detail">
    @foreach($meals as $meal)
        <div class="l-wrapper-no-padding-y p-meal-index-detail__meal">
            <a class="p-meal-index-detail__meal__photo" href="{{route('meal.show', $meal)}}">
                <img class="p-meal-index-detail__meal__photo__img" src="{{ asset('storage/images/meals/'.$meal->photo)}}" alt="料理">
            </a>
            <div class="p-meal-index-detail__meal__detail">
                <div class="p-meal-index-detail__meal__detail__parts">
                    <div class="p-meal-index-detail__meal__detail__parts__favorite j-favorite-parent">
                        <input class="j-favorite-parent__meal-id" type="hidden" value="{{ $meal->id }}">
                        @if(Auth::user()->isFavoritingingMeal($meal))
                            <img class="p-meal-index-detail__meal__detail__parts__favorite__img j-favorite-parent__favorite" src="{{ asset('storage/images/parts/favorite.svg')}}" alt="お気に入り" style="display: none;">
                            <img class="p-meal-index-detail__meal__detail__parts__favorite__img j-favorite-parent__favoriting" src="{{ asset('storage/images/parts/favorite_yellow.svg')}}" alt="お気に入り" style="display: block;">
                        @else
                            <img class="p-meal-index-detail__meal__detail__parts__favorite__img j-favorite-parent__favorite" src="{{ asset('storage/images/parts/favorite.svg')}}" alt="お気に入り" style="display: block;">
                            <img class="p-meal-index-detail__meal__detail__parts__favorite__img j-favorite-parent__favoriting" src="{{ asset('storage/images/parts/favorite_yellow.svg')}}" alt="お気に入り" style="display: none;">
                        @endif
                        <x-link class="j-favorite-parent__num" href="#">{{ count($meal->favoritedUsers) }}</x-link>
                    </div>
                    <div class="p-meal-index-detail__meal__detail__parts__good j-good-parent">
                        <input class="j-good-parent__meal-id" type="hidden" value="{{ $meal->id }}">
                        @if(Auth::user()->isGoodingMeal($meal))
                            <img class="p-meal-index-detail__meal__detail__parts__good__img j-good-parent__good" src="{{ asset('storage/images/parts/good.svg')}}" alt="いいね！" style="display: none;">
                            <img class="p-meal-index-detail__meal__detail__parts__good__img j-good-parent__gooding" src="{{ asset('storage/images/parts/good_pink.svg')}}" alt="いいね！" style="display: block;">
                        @else
                            <img class="p-meal-index-detail__meal__detail__parts__good__img j-good-parent__good" src="{{ asset('storage/images/parts/good.svg')}}" alt="いいね！" style="display: block;">
                            <img class="p-meal-index-detail__meal__detail__parts__good__img j-good-parent__gooding" src="{{ asset('storage/images/parts/good_pink.svg')}}" alt="いいね！" style="display: none;">
                        @endif
                        <x-link class="j-good-parent__num" href="#">{{ count($meal->goodedUsers) }}</x-link>
                    </div>
                </div>
                <div class="p-meal-index-detail__meal__detail__body-row">
                    <div class="p-meal-index-detail__meal__detail__body-row__body">
                        <p class="p-meal-index-detail__meal__detail__body-row__body__title">{{ $meal->title }}</p>
                        @if(!empty($meal->introduction))
                            <p class="p-meal-index-detail__meal__detail__body-row__body__introduction">{{ $meal->introduction }}</p>
                        @endif
                        @if(!empty($meal->shop_id) && !empty($meal->shop->address) && preg_match('@^(.{2,3}?[都道府県])(.+?郡.+?[町村]|.+?市.+?区|.+?[市区町村])(.+)@u', $meal->shop->address, $matches) === 1)
                            <p class="p-meal-index-detail__meal__detail__body-row__body__area">{{ $matches[1].$matches[2] }}</p>
                        @else
                            <p class="p-meal-index-detail__meal__detail__body-row__body__area"></p>
                        @endif
                        <a class="p-meal-index-detail__meal__detail__body-row__body__owner" href="#">
                            @if(empty($meal->user->icon))
                                <img class="p-meal-index-detail__meal__detail__body-row__body__owner__img" src="{{ asset('storage/images/parts/account.svg')}}" alt="アイコン">
                            @else
                                <img class="p-meal-index-detail__meal__detail__body-row__body__owner__img" src="{{ asset('storage/images/icons/'.$meal->user->icon)}}" alt="アイコン">
                            @endif
                            <p class="p-meal-index-detail__meal__detail__body-row__body__owner__name">&#064;{{ $meal->user->name }}</p>
                        </a>
                    </div>
                    <a  class="p-meal-index-detail__meal__detail__body-row__link" href="{{route('meal.show', $meal)}}">
                        <img class="p-meal-index-detail__meal__detail__body-row__link__img" src="{{ asset('storage/images/parts/link.svg')}}" alt="リンク">
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@vite(['resources/js/doms/meals/index-and-show/script.js'])
