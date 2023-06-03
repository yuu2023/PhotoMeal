<?php
$modalName = "";
$modalIsShow = false;
if(isset($mealReply)) {
    $modalName = 'meal-reply-edit'.$mealReply->id;
    $modalIsShow = $errors->replyUpdateError->isNotEmpty() && (old('is-submit'.$mealReply->id) === 'true');
} else {
    $modalName = 'meal-reply-create';
    $modalIsShow = $errors->replyStoreError->isNotEmpty();
}
?>

<x-modal name="{{ $modalName }}" :show="$modalIsShow">
    <div class="p-reply-create-and-edit-modal">
        @if(isset($mealReply))
            <form class="p-reply-create-and-edit-modal__form" method="post" action="{{ route('mealReply.update', $mealReply) }}">
                @csrf
                @method('patch')
        @else
            <form class="p-reply-create-and-edit-modal__form" method="post" action="{{ route('mealReply.store', $mealComment) }}">
                @csrf
        @endif
            <h2>
                @if(isset($mealReply))
                    返信を編集
                @else
                    返信を作成
                @endif
            </h2>

            <div class="p-reply-create-and-edit-modal__form__text">
                <x-input-label for="create-and-edit-modal__form__text__input" value="返信" />
                @if(isset($mealReply))
                    <x-textarea class="p-reply-create-and-edit-modal__form__text__input" id="create-and-edit-modal__form__text__input" name="text" type="text" rows="8" required maxlength="255">{{old('text'.$mealReply->id, $mealReply->text)}}</x-textarea>
                    <input class="p-reply-create-and-edit-modal__form__text__input-old" name="text{{ $mealReply->id }}" value="{{old('text'.$mealReply->id , $mealReply->text)}}">
                @else
                    <x-textarea class="p-reply-create-and-edit-modal__form__text__input" id="create-and-edit-modal__form__text__input" name="text" type="text" rows="8" required maxlength="255">{{old('text')}}</x-textarea>
                @endif
                @if(isset($mealReply))
                    @if(old('is-submit'.$mealReply->id) === 'true')
                        <x-input-error :messages="$errors->replyUpdateError->get('text')" class="p-reply-create-and-edit-modal__form__text__error" />
                    @endif
                @else
                    <x-input-error :messages="$errors->replyStoreError->get('text')" class="p-reply-create-and-edit-modal__form__text__error" />
                @endif
            </div>

            @if(isset($mealReply))
                <input class="p-reply-create-and-edit-modal__form__is-submit" name="is-submit{{ $mealReply->id }}" value="true">
            @endif

            <div class="p-reply-create-and-edit-modal__form__buttons">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="p-reply-create-and-edit-modal__form__buttons__submit" onClick="submit();">
                    @if(isset($mealReply))
                        保存
                    @else
                        作成
                    @endif
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
