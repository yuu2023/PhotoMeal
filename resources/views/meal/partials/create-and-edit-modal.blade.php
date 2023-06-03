<x-modal name="meal-create-and-edit" :show="$errors->mealError->isNotEmpty()">
    <div class="p-meal-create-and-edit-modal">
        @if(isset($meal))
            <form class="p-meal-create-and-edit-modal__form" method="post" action="{{ route('meal.update', $meal) }}" enctype="multipart/form-data" id="create-and-edit-modal__form">
                @csrf
                @method('patch')
        @else
            <form class="p-meal-create-and-edit-modal__form" method="post" action="{{ route('meal.store') }}" enctype="multipart/form-data" id="create-and-edit-modal__form">
                @csrf
        @endif
            <h2>
                @if(isset($meal))
                    料理を編集
                @else
                    料理を作成
                @endif
            </h2>

            <div class="p-meal-create-and-edit-modal__form__photo">
                <x-input-label for="create-and-edit-modal__form__photo__input" value="写真" id="create-and-edit-modal__form__photo__label1" />
                <input class="p-meal-create-and-edit-modal__form__photo__input" id="create-and-edit-modal__form__photo__input" type="file" name="photo_file">
                <input class="p-meal-create-and-edit-modal__form__photo__change-flag" type="text" id="create-and-edit-modal__form__photo__change-flag" name="photo_change_flag" value="0">
                <label class="p-meal-create-and-edit-modal__form__photo__body" for="create-and-edit-modal__form__photo__input" id="create-and-edit-modal__form__photo__label2">
                    <div class="p-meal-create-and-edit-modal__form__photo__body__create" id="create-and-edit-modal__form__photo__body__create">
                        <img class="p-meal-create-and-edit-modal__form__photo__body__create__img" src="{{ asset('storage/images/parts/create.svg') }}" alt="作成">
                    </div>
                    <img class="p-meal-create-and-edit-modal__form__photo__body__img" @if(isset($meal)) src="{{asset('storage/images/meals/'.$meal->photo)}}" @endif alt="写真" id="create-and-edit-modal__form__photo__body__img">
                </label>
                <x-input-error :messages="$errors->mealError->get('photo_file')" class="p-meal-create-and-edit-modal__form__photo__error" />
                <x-input-error messages="このファイルは使用できません。" class="p-meal-create-and-edit-modal__form__photo__js-error" id="create-and-edit-modal__form__photo__js-error" />
            </div>

            <div class="p-meal-create-and-edit-modal__form__title">
                <x-input-label for="create-and-edit-modal__form__title__input" value="タイトル" />
                @if(isset($meal))
                    <x-text-input class="p-meal-create-and-edit-modal__form__title__input" id="create-and-edit-modal__form__title__input" name="title" type="text" required maxlength="20" value="{{old('title', $meal->title)}}" />
                @else
                    <x-text-input class="p-meal-create-and-edit-modal__form__title__input" id="create-and-edit-modal__form__title__input" name="title" type="text" required maxlength="20" value="{{old('title')}}" />
                @endif
                <x-input-error :messages="$errors->mealError->get('title')" class="p-meal-create-and-edit-modal__form__title__error" />
            </div>

            <div class="p-meal-create-and-edit-modal__form__introduction">
                <x-input-label for="create-and-edit-modal__form__introduction__input" value="紹介文" />
                @if(isset($meal))
                    <x-textarea class="p-meal-create-and-edit-modal__form__introduction__input" id="create-and-edit-modal__form__introduction__input" type="text" name="introduction" rows="8" maxlength="500">{{old('introduction', $meal->introduction)}}</x-textarea>
                @else
                    <x-textarea class="p-meal-create-and-edit-modal__form__introduction__input" id="create-and-edit-modal__form__introduction__input" type="text" name="introduction" rows="8" maxlength="500">{{old('introduction')}}</x-textarea>
                @endif
                <x-input-error :messages="$errors->mealError->get('introduction')" class="p-meal-create-and-edit-modal__form__introduction__error" />
            </div>

            <div class="p-meal-create-and-edit-modal__form__shop">
                <x-input-label for="create-and-edit-modal__form__shop__input" value="店舗" />
                <p class="p-meal-create-and-edit-modal__form__shop__noto">※GPS情報をもとに店舗を表示しています。</p>

                @if(isset($meal) && !empty($meal->shop_id))
                    <input class="p-meal-create-and-edit-modal__form__shop__name" type="text" name="old_shop_name" id="create-and-edit-modal__form__shop__old-shop-name" value="{{old('old_shop_name', $meal->shop->name)}}">
                @else
                    <input class="p-meal-create-and-edit-modal__form__shop__name" type="text" name="old_shop_name" id="create-and-edit-modal__form__shop__old-shop-name" value="{{old('old_shop_name')}}">
                @endif

                <x-selectbox class="p-meal-create-and-edit-modal__form__shop__input" id="create-and-edit-modal__form__shop__input" size="5" name="shop_id">
                    @if(isset($meal))
                        @if(!empty(old('shop_id', $meal->shop_id)))
                            <option value="{{old('shop_id', $meal->shop_id)}}" selected>{{old('old_shop_name', isset($meal->shop->name)? $meal->shop->name: null)}}</option>
                        @endif
                    @else
                        @if(!empty(old('shop_id')))
                            <option value="{{old('shop_id')}}" selected>{{old('old_shop_name')}}</option>
                        @endif
                    @endif
                </x-selectbox>
                <x-input-error :messages="$errors->mealError->get('shop_id')" class="p-meal-create-and-edit-modal__form__shop__error" />

                <div class="p-meal-create-and-edit-modal__form__shop__search">
                    <div class="p-meal-create-and-edit-modal__form__shop__search__outer">
                        <x-text-input class="p-meal-create-and-edit-modal__form__shop__search__outer__input" id="create-and-edit-modal__form__shop__search__outer__input" type="search" name="shop_search" value="{{old('shop_search')}}" placeholder="見つからないときは検索してください。" />
                        <label for="create-and-edit-modal__form__shop__search__outer__input">
                            <img class="p-meal-create-and-edit-modal__form__shop__search__outer__label__img" src="{{ asset('storage/images/parts/search.svg')}}" alt="検索" id="create-and-edit-modal__form__shop__search__outer__label__img">
                        </label>
                    </div>
                    <x-input-error :messages="$errors->mealError->get('shop_search')" class="p-meal-create-and-edit-modal__form__shop__search__error" />
                </div>

                <div class="p-meal-create-and-edit-modal__form__shop__not-register">
                    <label class="p-meal-create-and-edit-modal__form__shop__not-register__label" for="create-and-edit-modal__form__shop__not-register__label__checkbox">
                        <input type="hidden" name="shop_not_register" value="false">
                        @if(isset($meal))
                            <x-checkbox id="create-and-edit-modal__form__shop__not-register__label__checkbox" name="shop_not_register" value="true" checked="{{old('shop_not_register', empty($meal->shop_id) ? 'true' : 'false' )}}" />
                        @else
                            <x-checkbox id="create-and-edit-modal__form__shop__not-register__label__checkbox" name="shop_not_register" value="true" checked="{{old('shop_not_register')}}" />
                        @endif
                        <span class="p-meal-create-and-edit-modal__form__shop__not-register__label__text">店舗を登録しない</span>
                    </label>
                    <p id="create-and-edit-modal__form__shop__not-register__caution" class="p-meal-create-and-edit-modal__form__shop__not-register__caution">
                        （注意）店舗を登録しないと、マップ表示が利用できないなど、一部の機能が使えなくなります。
                    </p>
                </div>
            </div>

            <div class="p-meal-create-and-edit-modal__form__visibility">
                <x-input-label for="create-and-edit-modal__form__visibility__input" value="公開範囲" />
                <x-selectbox class="p-meal-create-and-edit-modal__form__visibility__input" id="create-and-edit-modal__form__visibility__input" size="3" name="visibility">
                    <option value="public" selected>全体</option>
                    @if(isset($meal))
                        <option value="friends" @if(old('visibility', $meal->visibility) === 'friends') selected @endif>フレンド</option>
                        <option value="private" @if(old('visibility', $meal->visibility) === 'private') selected @endif>非公開</option>
                    @else
                        <option value="friends" @if(old('visibility') === 'friends') selected @endif>フレンド</option>
                        <option value="private" @if(old('visibility') === 'private') selected @endif>非公開</option>
                    @endif
                </x-selectbox>
                <x-input-error :messages="$errors->mealError->get('visibility')" class="p-meal-create-and-edit-modal__form__visibility__error" />
            </div>

            <div class="p-meal-create-and-edit-modal__form__can-others-use">
                <x-input-label for="create-and-edit-modal__form__can-others-use__input" value="この料理を他の人がメニューに追加することを許可しますか？" />
                <x-selectbox class="p-meal-create-and-edit-modal__form__can-others-use__input" id="create-and-edit-modal__form__can-others-use__input" size="2" name="can_others_use">
                    <option value='1' selected>許可する</option>
                    @if(isset($meal))
                        <option value='0' @if(old('can_others_use', $meal->can_others_use) === 0 || old('can_others_use', $meal->can_others_use) === '0') selected @endif>許可しない</option>
                    @else
                        <option value='0' @if(old('can_others_use') === '0') selected @endif>許可しない</option>
                    @endif
                </x-selectbox>
                <x-input-error :messages="$errors->mealError->get('can_others_use')" class="p-meal-create-and-edit-modal__form__can-others-use__error" />
            </div>

            <div class="p-meal-create-and-edit-modal__form__buttons">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="p-meal-create-and-edit-modal__form__buttons__submit" id='create-and-edit-modal__form__buttons__submit'>
                    @if(isset($meal))
                        保存
                    @else
                        作成
                    @endif
                </x-primary-button>
            </div>
        </form>
    </div>
    @vite(['resources/js/doms/meals/create-and-edit/script.js'])
    <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
</x-modal>
