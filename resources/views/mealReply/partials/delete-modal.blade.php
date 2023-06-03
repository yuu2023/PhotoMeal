<x-modal name="meal-reply-delete{{ $mealReply->id }}">
    <div class="p-reply-delete-modal">
        <form class="p-reply-delete-modal__form" method="post" action="{{route('mealReply.destroy', $mealReply)}}">
            @csrf
            @method('delete')

            <h2>コメントを削除</h2>
            <p class="p-reply-delete-modal__form__description">この返信を削除します。</p>
            <div class="p-reply-delete-modal__form__buttons">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="p-reply-delete-modal__form__buttons__submit" onClick="submit();">
                    削除
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
