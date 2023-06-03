<x-app-layout>
    @if (isset($_GET['status']) && $_GET['status'] === 'profile-destroyed' && $errors->default->isEmpty())
        <x-message>
            アカウントを削除しました。
        </x-message>
    @endif

    @if (isset($_GET['status']) && $_GET['status'] === 'logout' && $errors->default->isEmpty())
        <x-message>
            ログアウトしました。
        </x-message>
    @endif

    @if ($errors->default->isNotEmpty())
        <x-error-message>
            ログインに失敗しました。
        </x-error-message>
    @endif

    <div class="l-wrapper">
        <div class="p-login">
            <div class="p-login__logo">
                <img class="p-login__logo__img" src="{{ asset('storage/images/parts/yummy.svg')}}" alt="ロゴ">
                <h1 class="p-login__logo__text">ふぉとミール！</h1>
            </div>

            <form class="p-login__form" method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="p-login__form__email">
                    <x-input-label for="email__input" value="{{__('Email')}}" />
                    <x-text-input class="p-login__form__email__input" id="email__input" type="email" name="email" value="{{old('email')}}" required autocomplete="username" maxlength="255" />
                    <x-input-error :messages="$errors->get('email')" class="p-login__form__email__error" />
                </div>

                <!-- Password -->
                <div class="p-login__form__password">
                    <x-input-label for="password__input" value="{{__('Password')}}" />
                    <x-text-input class="p-login__form__password__input" id="password__input" name="password" type="password" required autocomplete="current-password" maxlength="255" />
                    <x-input-error :messages="$errors->get('password')" class="p-login__form__password__error" />
                </div>

                <!-- Remember Me -->
                <div class="p-login__form__remember-me">
                    <label class="p-login__form__remember-me__label" for="remember-me__label__checkbox">
                        <input type="hidden" name="remember" value="false">
                        <x-checkbox id="remember-me__label__checkbox" name="remember" value="true" checked="{{old('remember')}}" />
                        <span class="p-login__form__remember-me__label__text">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="p-login__form__submit">
                    <x-link href="{{ route('register') }}">
                        アカウントを作成
                    </x-link>

                    <x-primary-button class="p-login__form__submit__login" onClick="submit();">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
