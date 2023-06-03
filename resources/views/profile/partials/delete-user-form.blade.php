<section class="l-wrapper">
    <div class="p-user-delete">
        <h2>
            {{ __('Delete Account') }}
        </h2>

        <p class="p-user-delete__description">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>

        <div class="p-user-delete__submit">
            <x-danger-button class='p-user-delete__submit__delete' x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                {{ __('Delete Account') }}
            </x-danger-button>
        </div>

        @include('profile.partials.delete-modal')
    </div>
</section>
