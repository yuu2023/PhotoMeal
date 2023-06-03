<x-app-layout>
    <div class="p-comment-index">
        <div class="p-comment-index__header-row">
            <h3>コメント</h3>
            <img class="p-comment-index__header-row__create" src="{{ asset('storage/images/parts/create.svg')}}" alt="作成" x-data="" x-on:click.prevent="$dispatch('open-modal', 'meal-comment-create-and-edit')">
        </div>
        @if(count($mealComments) === 0)
            <p class="p-comment-index__none">まだコメントはありません。</p>
        @else
            @foreach($mealComments as $mealCommentForShow)
                <div class="p-comment-index__body">
                    <div class="p-comment-index__body__user-row">
                        <a class="p-comment-index__body__user-row__link" href="#">
                            @if(empty($mealCommentForShow->user->icon))
                                <img class="p-comment-index__body__user-row__link__img" src="{{ asset('storage/images/parts/account.svg')}}" alt="オーナー">
                            @else
                                <img class="p-comment-index__body__user-row__link__img" src="{{ asset('storage/images/icons/'.$mealCommentForShow->user->icon)}}" alt="オーナー">
                            @endif
                            <p>&#064;{{ $mealCommentForShow->user->name }}</p>
                        </a>
                        <p>返信({{ count($mealCommentForShow->mealReplies) }}件)</p>
                    </div>
                    <div class="p-comment-index__body__comment-row">
                        <p class="p-comment-index__body__comment-row__text">{{ $mealCommentForShow->text }}</p>
                        <a class="p-comment-index__body__comment-row__link" href="{{route('mealComment.show', $mealCommentForShow)}}">
                            <img class="p-comment-index__body__comment-row__link__img" src="{{ asset('storage/images/parts/link.svg')}}" alt="リンク">
                        </a>
                    </div>
                </div>
            @endforeach
            <div class="p-comment-index__pages">
                {{$mealComments->links()}}
            </div>
            <div class="p-comment-index__back">
                <x-link class="p-comment-index__back__link" href="{{route('meal.show', $meal)}}">料理に戻る</x-link>
            </div>
        @endif
    </div>
    @include('mealComment.partials.create-and-edit-modal')
</x-app-layout>
