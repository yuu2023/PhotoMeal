<x-modal name="meal-delete">
    <div class="p-meal-delete-modal">
        <form class="p-meal-delete-modal__form" method="post" action="{{route('meal.destroy', $meal)}}">
            @csrf
            @method('delete')

            <h2>料理を削除</h2>
            <p class="p-meal-delete-modal__form__description">料理を削除すると、この料理を利用しているメニューからも削除されます。</p>
            <div class="p-meal-delete-modal__form__buttons">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="p-meal-delete-modal__form__buttons__submit" onClick="submit();">
                    削除
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
