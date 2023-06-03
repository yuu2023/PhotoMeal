<div class="p-meal-index-common">
    <form method="GET" action="{{ route('meal.index') }}" id="form">
        <div class="p-meal-index-common__form__search">
            <x-text-input class="p-meal-index-common__form__search__input" id="form__search__input" type="search" name="search" placeholder="検索キーワードを入力してください。" value="{{old('search', $search)}}" />
            <label for="form__search__input">
                <img class="p-meal-index-common__form__search__label__img" src="{{ asset('storage/images/parts/search.svg')}}" alt="検索">
            </label>
        </div>
        <div class="p-meal-index-common__form__select">
            <div class="p-meal-index-common__form__select__filter">
                <x-selectbox class="p-meal-index-common__form__select__filter__input" id="form__select__filter__input" name="filter">
                    <option value="all" @if(old('filter', $filter) === 'all') selected @endif>全て</option>
                    <option value="own" @if(old('filter', $filter) === 'own') selected @endif>自分</option>
                    <option value="friend" @if(old('filter', $filter) === 'friend') selected @endif>フレンド</option>
                    <option value="favorite" @if(old('filter', $filter) === 'favorite') selected @endif>お気に入り</option>
                    @if(!empty(Auth::user()->area))
                        <option value="area" @if(old('filter', $filter) === 'area') selected @endif>活動地域</option>
                    @endif
                    <option value="near" @if(old('filter', $filter) === 'near') selected @endif id="form__select__filter__input__near">近くの料理</option>
                </x-selectbox>
                <label for="form__select__filter__input">
                    <img class="p-meal-index-common__form__select__filter__label__img" src="{{ asset('storage/images/parts/filter.svg')}}" alt="フィルター">
                </label>
                <input type="hidden" id="form__select__filter__latitude" name="latitude">
                <input type="hidden" id="form__select__filter__longitude" name="longitude">
            </div>
            <div class="p-meal-index-common__form__select__sort">
                <x-selectbox class="p-meal-index-common__form__select__sort__input" id="form__select__sort__input" name="sort">
                    <option value="register" @if(old('sort', $sort) === 'register') selected @endif>登録順</option>
                    <option value="good" @if(old('sort', $sort) === 'good') selected @endif>いいね！</option>
                    <option value="random" @if(old('sort', $sort) === 'random') selected @endif>気まぐれ</option>
                </x-selectbox>
                <label for="form__select__sort__input">
                    <img class="p-meal-index-common__form__select__sort__label__img" src="{{ asset('storage/images/parts/sort.svg')}}" alt="ソート">
                </label>
            </div>
        </div>

        <input type="hidden" name="mode" value="{{old('mode', $mode)}}" id="form__mode">

        @if(isset($_GET['page']))
            <input type="hidden" value="{{old('page', $_GET['page'])}}" id="form__page-temp">
        @else
            <input type="hidden" value="" id="form__page-temp">
        @endif
        <input type="hidden" name="page" id="form__page">

    </form>

    <div class="p-meal-index-common__mode-and-create">
        <div class="p-meal-index-common__mode-and-create__mode">
            @if($mode === 'grid')
                <div class="p-meal-index-common__mode-and-create__mode__grid" id="mode-and-create__mode__grid" style="background-color: #4b4b4b;">
                    <img  class="p-meal-index-common__mode-and-create__mode__grid__img" src="{{ asset('storage/images/parts/grid.svg')}}" alt="グリッド" style="display: none">
                    <img  class="p-meal-index-common__mode-and-create__mode__grid__img" src="{{ asset('storage/images/parts/grid-white.svg')}}" alt="グリッド">
                </div>
            @else
                <div class="p-meal-index-common__mode-and-create__mode__grid" id="mode-and-create__mode__grid" style="cursor: pointer;">
                    <img  class="p-meal-index-common__mode-and-create__mode__grid__img" src="{{ asset('storage/images/parts/grid.svg')}}" alt="グリッド">
                    <img  class="p-meal-index-common__mode-and-create__mode__grid__img" src="{{ asset('storage/images/parts/grid-white.svg')}}" alt="グリッド" style="display: none">
                </div>
            @endif

            @if($mode === 'detail')
                <div class="p-meal-index-common__mode-and-create__mode__detail" id="mode-and-create__mode__detail" style="background-color: #4b4b4b;">
                    <img  class="p-meal-index-common__mode-and-create__mode__detail__img" src="{{ asset('storage/images/parts/detail.svg')}}" alt="詳細" style="display: none">
                    <img  class="p-meal-index-common__mode-and-create__mode__detail__img" src="{{ asset('storage/images/parts/detail-white.svg')}}" alt="詳細">
                </div>
            @else
                <div class="p-meal-index-common__mode-and-create__mode__detail" id="mode-and-create__mode__detail" style="cursor: pointer;">
                    <img  class="p-meal-index-common__mode-and-create__mode__detail__img" src="{{ asset('storage/images/parts/detail.svg')}}" alt="詳細">
                    <img  class="p-meal-index-common__mode-and-create__mode__detail__img" src="{{ asset('storage/images/parts/detail-white.svg')}}" alt="詳細" style="display: none">
                </div>
            @endif

            @if($mode === 'map')
                <div class="p-meal-index-common__mode-and-create__mode__map" id="mode-and-create__mode__map" style="background-color: #4b4b4b;">
                    <img  class="p-meal-index-common__mode-and-create__mode__map__img" src="{{ asset('storage/images/parts/map.svg')}}" alt="マップ" style="display: none">
                    <img  class="p-meal-index-common__mode-and-create__mode__map__img" src="{{ asset('storage/images/parts/map-white.svg')}}" alt="マップ">
                </div>
            @else
                <div class="p-meal-index-common__mode-and-create__mode__map" id="mode-and-create__mode__map" style="cursor: pointer;">
                    <img  class="p-meal-index-common__mode-and-create__mode__map__img" src="{{ asset('storage/images/parts/map.svg')}}" alt="マップ">
                    <img  class="p-meal-index-common__mode-and-create__mode__map__img" src="{{ asset('storage/images/parts/map-white.svg')}}" alt="マップ" style="display: none">
                </div>
            @endif

        </div>
        <div class="p-meal-index-common__mode-and-create__create">
            <img class="p-meal-index-common__mode-and-create__create__img" src="{{ asset('storage/images/parts/create_big.svg')}}" alt="作成"  x-data="" x-on:click.prevent="$dispatch('open-modal', 'meal-create-and-edit')">
        </div>
    </div>

    @include('meal.partials.create-and-edit-modal')
</div>
@vite(['resources/js/doms/meals/index/script.js'])
