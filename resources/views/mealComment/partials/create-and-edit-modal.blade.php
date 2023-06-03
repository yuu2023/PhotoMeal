<x-modal name="meal-comment-create-and-edit" :show="$errors->commentError->isNotEmpty()">
    <div class="p-comment-create-and-edit-modal">
        @if(isset($mealComment))
            <form class="p-comment-create-and-edit-modal__form" method="post" action="{{ route('mealComment.update', $mealComment) }}">
                @csrf
                @method('patch')
        @else
            <form class="p-comment-create-and-edit-modal__form" method="post" action="{{ route('mealComment.store', $meal) }}">
                @csrf
        @endif
            <h2>
                @if(isset($mealComment))
                    コメントを編集
                @else
                    コメントを作成
                @endif
            </h2>

            <div class="p-comment-create-and-edit-modal__form__text">
                <x-input-label for="create-and-edit-modal__form__text__input" value="コメント" />
                @if(isset($mealComment))
                    <x-textarea class="p-comment-create-and-edit-modal__form__text__input" id="create-and-edit-modal__form__text__input" name="text" type="text" rows="8" required maxlength="255">{{old('text', $mealComment->text)}}</x-textarea>
                @else
                    <x-textarea class="p-comment-create-and-edit-modal__form__text__input" id="create-and-edit-modal__form__text__input" name="text" type="text" rows="8" required maxlength="255">{{old('text')}}</x-textarea>
                @endif
                <x-input-error :messages="$errors->commentError->get('text')" class="p-comment-create-and-edit-modal__form__text__error" />
            </div>

            <div class="p-comment-create-and-edit-modal__form__buttons">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="p-comment-create-and-edit-modal__form__buttons__submit" onClick="submit();">
                    @if(isset($mealComment))
                        保存
                    @else
                        作成
                    @endif
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
