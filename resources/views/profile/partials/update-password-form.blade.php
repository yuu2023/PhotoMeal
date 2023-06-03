@if (session('status') === 'password-updated')
    <x-message>
        パスワードを更新しました。
    </x-message>
@endif

@if ($errors->updatePassword->isNotEmpty())
    <x-error-message>
        パスワードの更新に失敗しました。
    </x-error-message>
@endif

<section class="l-wrapper">
    <div class="p-user-update-password">
        <h2>
            {{ __('Update Password') }}
        </h2>

        <p class="p-user-update-password__description">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>

        <form  class="p-user-update-password__form" method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <!-- Current Password -->
            <div class="p-user-update-password__form__current-password">
                <x-input-label for="current-password__input" value="{{__('Current Password')}}" />
                <x-text-input id="current-password__input" class="p-user-update-password__form__current-password__input" type="password" name="current_password" required autocomplete="current-password" maxlength="255"/>
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="p-user-update-password__form__current-password__error" />
            </div>

            <!-- New Password -->
            <div class="p-user-update-password__form__new-password">
                <x-input-label for="new-password__input" value="{{__('New Password')}}" />
                <x-text-input id="new-password__input" class="p-user-update-password__form__new-password__input" type="password" name="password" required autocomplete="new-password" maxlength="255"/>
                <x-input-error :messages="$errors->updatePassword->get('password')" class="p-user-update-password__form__new-password__error" />
            </div>

            <!-- Confirm Password -->
            <div class="p-user-update-password__form__confirm-password">
                <x-input-label for="confirm-password__input" value="{{__('Confirm Password')}}" />
                <x-text-input id="confirm-password__input" class="p-user-update-password__form__confirm-password__input" type="password" name="password_confirmation" required autocomplete="new-password" maxlength="255"/>
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="p-user-update-password__form__confirm-password__error" />
            </div>

            <div class="p-user-update-password__form__submit">
                <x-primary-button class="p-user-update-password__form__submit__save" onClick="submit();">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</section>

@vite(['resources/js/doms/users/create-and-edit/script.js'])
