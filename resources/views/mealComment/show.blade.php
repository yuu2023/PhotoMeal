<x-app-layout>
    @if (session('status') === 'comment-store')
        <x-message>
            コメントを作成しました。
        </x-message>
    @endif
    @if (session('status') === 'comment-update')
        <x-message>
            コメントを編集しました。
        </x-message>
    @endif
    @if (session('status') === 'reply-store')
        <x-message>
            返信を作成しました。
        </x-message>
    @endif
    @if (session('status') === 'reply-update')
        <x-message>
            返信を編集しました。
        </x-message>
    @endif
    @if (session('status') === 'reply-delete')
        <x-message>
            返信を削除しました。
        </x-message>
    @endif

    <div class="p-comment-show">
        <div class="p-comment-show__comment">
            <div class="p-comment-show__comment__header">
                <h3>コメント</h3>
            </div>
            <div class="p-comment-show__comment__body">
                <div class="p-comment-show__comment__body__user-row">
                    <a class="p-comment-show__comment__body__user-row__link" href="#">
                        @if(empty($mealComment->user->icon))
                            <img class="p-comment-show__comment__body__user-row__link__img" src="{{ asset('storage/images/parts/account.svg')}}" alt="オーナー">
                        @else
                            <img class="p-comment-show__comment__body__user-row__link__img" src="{{ asset('storage/images/icons/'.$mealComment->user->icon)}}" alt="オーナー">
                        @endif
                        <p>&#064;{{ $mealComment->user->name }}</p>
                    </a>
                    @if($mealComment->user->id === Auth::id())
                        <div class="p-comment-show__comment__body__user-row__parts">
                            <div class="p-comment-show__comment__body__user-row__parts__create">
                                <img class="p-comment-show__comment__body__user-row__parts__create__img" src="{{ asset('storage/images/parts/edit.svg')}}" alt="編集"  x-data="" x-on:click.prevent="$dispatch('open-modal', 'meal-comment-create-and-edit')">
                            </div>
                            <div class="p-comment-show__comment__body__user-row__parts__delete">
                                <img class="p-comment-show__comment__body__user-row__parts__delete__img" src="{{ asset('storage/images/parts/delete.svg')}}" alt="削除"  x-data="" x-on:click.prevent="$dispatch('open-modal', 'meal-comment-delete')">
                            </div>
                        </div>
                    @endif
                </div>
                <p class="p-comment-show__comment__body__text">{{ $mealComment->text }}</p>
            </div>
        </div>
        <div class="p-comment-show__reply">
            <div class="p-comment-show__reply__header-row">
                <h3>返信</h3>
                <img class="p-comment-show__reply__header-row__create" src="{{ asset('storage/images/parts/create.svg')}}" alt="作成" x-data="" x-on:click.prevent="$dispatch('open-modal', 'meal-reply-create')">
                @include('mealReply.partials.create-and-edit-modal')
            </div>
            @if(count($mealReplies) === 0)
                <p class="p-comment-show__reply__none">まだ返信はありません。</p>
            @else
                @foreach($mealReplies as $mealReply)
                    <div class="p-comment-show__reply__body">
                        <div class="p-comment-show__reply__body__user-row">
                            <a class="p-comment-show__reply__body__user-row__link" href="#">
                                @if(empty($mealReply->user->icon))
                                    <img class="p-comment-show__reply__body__user-row__link__img" src="{{ asset('storage/images/parts/account.svg')}}" alt="オーナー">
                                @else
                                    <img class="p-comment-show__reply__body__user-row__link__img" src="{{ asset('storage/images/icons/'.$mealReply->user->icon)}}" alt="オーナー">
                                @endif
                                <p>&#064;{{ $mealReply->user->name }}</p>
                            </a>
                            @if($mealReply->user->id === Auth::id())
                                <div class="p-comment-show__reply__body__user-row__parts">
                                    <div class="p-comment-show__reply__body__user-row__parts__create">
                                        <img class="p-comment-show__reply__body__user-row__parts__create__img" src="{{ asset('storage/images/parts/edit.svg')}}" alt="編集"  x-data="" x-on:click.prevent="$dispatch('open-modal', 'meal-reply-edit{{ $mealReply->id }}')">
                                    </div>
                                    <div class="p-comment-show__reply__body__user-row__parts__delete">
                                        <img class="p-comment-show__reply__body__user-row__parts__delete__img" src="{{ asset('storage/images/parts/delete.svg')}}" alt="削除"  x-data="" x-on:click.prevent="$dispatch('open-modal', 'meal-reply-delete{{ $mealReply->id }}')">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <p class="p-comment-show__reply__body__text">{{ $mealReply->text }}</p>
                    </div>
                    @include('mealReply.partials.create-and-edit-modal')
                    @include('mealReply.partials.delete-modal')
                @endforeach
                <div class="p-comment-show__reply__pages">
                    {{$mealReplies->links()}}
                </div>
            @endif
        </div>
        <div class="p-comment-show__back">
            <x-link class="p-comment-show__back__link" href="{{route('meal.show', $mealComment->meal)}}">料理に戻る</x-link>
        </div>
    </div>
    @include('mealComment.partials.create-and-edit-modal')
    @include('mealComment.partials.delete-modal')
</x-app-layout>
