<x-modal name="meal-comment-delete">
    <div class="p-comment-delete-modal">
        <form class="p-comment-delete-modal__form" method="post" action="{{route('mealComment.destroy', $mealComment)}}">
            @csrf
            @method('delete')

            <h2>コメントを削除</h2>
            <p class="p-comment-delete-modal__form__description">このコメントを削除します。</p>
            <div class="p-comment-delete-modal__form__buttons">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="p-comment-delete-modal__form__buttons__submit" onClick="submit();">
                    削除
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
