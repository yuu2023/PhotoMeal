<x-app-layout>
    @if ($errors->default->isNotEmpty())
        <x-error-message>
            アカウントの作成に失敗しました。
        </x-error-message>
    @endif

    <div class="l-wrapper">
        <div class="p-user-register">
            <div class="p-user-register__logo">
                <img class="p-user-register__logo__img" src="{{ asset('storage/images/parts/yummy.svg') }}" alt="ロゴ">
                <h1 class="p-user-register__logo__text">ふぉとミール！</h1>
            </div>

            <form class="p-user-register__form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="p-user-register__form__name">
                    <x-input-label for="name__input" value="{{__('Name')}}" />
                    <x-text-input class="p-user-register__form__name__input" id="name__input" type="text" name="name" value="{{old('name')}}" required autocomplete="username" maxlength="10" />
                    <x-input-error :messages="$errors->get('name')" class="p-user-register__form__name__error" />
                </div>

                <!-- Introduction -->
                <div class="p-user-register__form__introduction">
                    <x-input-label for="introduction__input" value="紹介文" />
                    <x-textarea class="p-user-register__form__introduction__input" id="introduction__input" type="text" name="introduction" rows="8" maxlength="160">{{old('introduction')}}</x-textarea>
                    <x-input-error :messages="$errors->get('introduction')" class="p-user-register__form__introduction__error" />
                </div>

                <!-- Icon -->
                <div class="p-user-register__form__icon">
                    <x-input-label for="icon__input" value="アイコン" id="icon__label1"/>
                    <input class="p-user-register__form__icon__input" id="icon__input" type="file" name="icon_file" >
                    <input class="p-user-register__form__icon__change-flag" type="text" id="icon__change-flag" value="0" >
                    <label class="p-user-register__form__icon__body" for="icon__input" id="icon__label2">
                        <div class="p-user-register__form__icon__body__create" id="icon__body__create">
                            <img class="p-user-register__form__icon__body__create__img" src="{{ asset('storage/images/parts/create.svg') }}" alt="作成">
                        </div>
                        <img class="p-user-register__form__icon__body__img" alt="アイコン" id="icon__body__img">
                    </label>
                    <x-input-error :messages="$errors->get('icon_file')" class="p-user-register__form__icon__error" />
                    <x-input-error messages="このファイルは使用できません。" class="p-user-register__form__icon__js-error" id="icon__js-error" />
                </div>

                <!-- Area -->
                <div class="p-user-register__form__area">
                    <x-input-label for="area__input" value="活動地域" />
                    <p class="p-user-register__form__area__noto">※GPS情報をもとに地域を表示しています。</p>
                    <x-selectbox class="p-user-register__form__area__input" id="area__input" size="5" name="area">
                        @if(!empty(old('area')))
                            <option value="{{old('area')}}" selected>{{old('area')}}</option>
                        @endif
                    </x-selectbox>
                    <x-input-error :messages="$errors->get('area')" class="p-user-register__form__area__error" />

                    <!-- Area Search -->
                    <div class="p-user-register__form__area__search">
                        <div class="p-user-register__form__area__search__outer">
                            <x-text-input class="p-user-register__form__area__search__outer__input" id="area__search__outer__input" type="search" name="area_search" value="{{old('area_search')}}" placeholder="見つからないときは検索してください。" />
                            <label for="area__search__outer__input">
                                <img class="p-user-register__form__area__search__outer__label__img" src="{{ asset('storage/images/parts/search.svg')}}" alt="検索" id="area__search__outer__label__img">
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('area_search')" class="p-user-register__form__arae__search__error" />
                    </div>

                    <!-- Area Not Register -->
                    <div class="p-user-register__form__area__not-register">
                        <label class="p-user-register__form__area__not-register__label" for="area__not-register__label__checkbox">
                            <input type="hidden" name="area_not_register" value="false">
                            <x-checkbox id="area__not-register__label__checkbox" name="area_not_register" value="true" checked="{{old('area_not_register')}}" />
                            <span class="p-user-register__form__area__not-register__label__text">活動地域を登録しない</span>
                        </label>
                        <p id="area__not-register__caution" class="p-user-register__form__area__not-register__caution">
                            （注意）活動地域を登録しないと、活動地域からの料理、メニューの絞り込みができなくなるなど、一部の機能が使えなくなります。
                        </p>
                    </div>

                    <!-- Area Visibility -->
                    <div class="p-user-register__form__area__visibility">
                        <x-input-label for="area__visibility__input" value="活動地域の公開範囲" />
                        <x-selectbox class="p-user-register__form__area__visibility__input" id="area__visibility__input" size="3" name="area_visibility">
                            <option value="public" selected>全体</option>
                            <option value="friends" @if(old('area_visibility') === 'friends') selected @endif>フレンド</option>
                            <option value="private" @if(old('area_visibility') === 'private') selected @endif>非公開</option>
                        </x-selectbox>
                        <x-input-error :messages="$errors->get('area_visibility')" class="p-user-register__form__area__visibility__error" />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="p-user-register__form__email">
                    <x-input-label for="email__input" value="{{__('Email')}}" />
                    <x-text-input id="email__input" class="p-user-register__form__email__input" type="email" name="email" value="{{old('email')}}" required autocomplete="username" maxlength="255" />
                    <x-input-error :messages="$errors->get('email')" class="p-user-register__form__email__error" />
                </div>

                <!-- Password -->
                <div class="p-user-register__form__password">
                    <x-input-label for="password__input" value="{{__('Password')}}" />
                    <x-text-input id="password__input" class="p-user-register__form__password__input" type="password" name="password" required autocomplete="new-password" maxlength="255"/>
                    <x-input-error :messages="$errors->get('password')" class="p-user-register__form__password__error" />
                </div>

                <!-- Confirm Password -->
                <div class="p-user-register__form__password-confirmation">
                    <x-input-label for="password-confirmation__input" value="{{__('Confirm Password')}}" />
                    <x-text-input id="password-confirmation__input" class="p-user-register__form__password-confirmation__input" type="password" name="password_confirmation" required autocomplete="new-password" maxlength="255"/>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="p-user-register__form__password-confirmation__error" />
                </div>

                <div class="p-user-register__form__submit">
                    <x-link href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </x-link>

                    <x-primary-button class="p-user-register__form__submit__register" onClick="submit();">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
    @vite(['resources/js/doms/users/create-and-edit/script.js'])
</x-app-layout>
