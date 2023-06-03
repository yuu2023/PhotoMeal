<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()">
    <div class="p-user-delete-modal">
        <form class="p-user-delete-modal__form" method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <h2>
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="p-user-delete-modal__form__description">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="p-user-delete-modal__form__password">

                {{-- <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" /> --}}

                <x-text-input class="p-user-delete-modal__form__password__input" id="password" name="password" type="password" placeholder="{{ __('Password') }}"/>
                <x-input-error :messages="$errors->userDeletion->get('password')" class="p-user-delete-modal__form__password__error" />
            </div>

            <div class="p-user-delete-modal__form__submit">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="p-user-delete-modal__form__submit__delete">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </div>
</x-modal>
