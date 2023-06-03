<x-app-layout>
    @if (session('status') === 'meal-store')
        <x-message>
            料理を作成しました。
        </x-message>
    @endif
    @if (session('status') === 'meal-update')
        <x-message>
            料理を編集しました。
        </x-message>
    @endif
    @if (session('status') === 'comment-destroy')
        <x-message>
            コメントを削除しました。
        </x-message>
    @endif

    <div class="p-meal-show">
        <div class="l-wrapper">
            <section class="p-meal-show__meal">
                <h2>{{ $meal->title }}</h2>
                @if($meal->user_id === Auth::id())
                    <div class="p-meal-show__meal__parts">
                        <div class="p-meal-show__meal__parts__create">
                            <img class="p-meal-show__meal__parts__create__img" src="{{ asset('storage/images/parts/edit.svg')}}" alt="編集"  x-data="" x-on:click.prevent="$dispatch('open-modal', 'meal-create-and-edit')">
                        </div>
                        <div class="p-meal-show__meal__parts__delete">
                            <img class="p-meal-show__meal__parts__delete__img" src="{{ asset('storage/images/parts/delete.svg')}}" alt="削除"  x-data="" x-on:click.prevent="$dispatch('open-modal', 'meal-delete')">
                        </div>
                    </div>
                @endif

                <div class="p-meal-show__meal__create-date-row">
                    <p>{{ date('Y/m/d', strtotime($meal->created_at)) }}</p>
                    <div class="p-meal-show__meal__create-date-row__parts">
                        <div class="p-meal-show__meal__create-date-row__parts__favorite j-favorite-parent">
                            <input class="j-favorite-parent__meal-id" type="hidden" value="{{ $meal->id }}">
                            @if(Auth::user()->isFavoritingingMeal($meal))
                                <img class="p-meal-show__meal__create-date-row__parts__favorite__img j-favorite-parent__favorite" src="{{ asset('storage/images/parts/favorite.svg')}}" alt="お気に入り" style="display: none;">
                                <img class="p-meal-show__meal__create-date-row__parts__favorite__img j-favorite-parent__favoriting" src="{{ asset('storage/images/parts/favorite_yellow.svg')}}" alt="お気に入り" style="display: block;">
                            @else
                                <img class="p-meal-show__meal__create-date-row__parts__favorite__img j-favorite-parent__favorite" src="{{ asset('storage/images/parts/favorite.svg')}}" alt="お気に入り" style="display: block;">
                                <img class="p-meal-show__meal__create-date-row__parts__favorite__img j-favorite-parent__favoriting" src="{{ asset('storage/images/parts/favorite_yellow.svg')}}" alt="お気に入り" style="display: none;">
                            @endif
                            <x-link class="j-favorite-parent__num" href="#">{{ count($meal->favoritedUsers) }}</x-link>
                        </div>
                        <div class="p-meal-show__meal__create-date-row__parts__good j-good-parent">
                            <input class="j-good-parent__meal-id" type="hidden" value="{{ $meal->id }}">
                            @if(Auth::user()->isGoodingMeal($meal))
                                <img class="p-meal-show__meal__create-date-row__parts__good__img j-good-parent__good" src="{{ asset('storage/images/parts/good.svg')}}" alt="いいね！" style="display: none;">
                                <img class="p-meal-show__meal__create-date-row__parts__good__img j-good-parent__gooding" src="{{ asset('storage/images/parts/good_pink.svg')}}" alt="いいね！" style="display: block;">
                            @else
                                <img class="p-meal-show__meal__create-date-row__parts__good__img j-good-parent__good" src="{{ asset('storage/images/parts/good.svg')}}" alt="いいね！" style="display: block;">
                                <img class="p-meal-show__meal__create-date-row__parts__good__img j-good-parent__gooding" src="{{ asset('storage/images/parts/good_pink.svg')}}" alt="いいね！" style="display: none;">
                            @endif
                            <x-link class="j-good-parent__num" href="#">{{ count($meal->goodedUsers) }}</x-link>
                        </div>
                    </div>
                </div>
                <div class="p-meal-show__meal__meal">
                    <img class="p-meal-show__meal__meal__img" src="{{ asset('storage/images/meals/'.$meal->photo)}}" alt="料理">
                </div>
                <div class="p-meal-show__meal__add-to-menu-row">
                    <x-link href="#">料理をメニューに追加</x-link>
                    @if(!empty($meal->ate_date))
                        <div class="p-meal-show__meal__add-to-menu-row__ate-date">
                            <p class="p-meal-show__meal__add-to-menu-row__ate-date__string">食べた日</p>
                            <p>{{ date('Y/m/d', strtotime($meal->ate_date)) }}</p>
                        </div>
                    @endif
                </div>
            </section>
            <section class="p-meal-show__owner">
                <div class="p-meal-show__owner__owner-row">
                    <a class="p-meal-show__owner__owner-row__link" href="#">
                        @if(empty($meal->user->icon))
                            <img class="p-meal-show__owner__owner-row__link__img" src="{{ asset('storage/images/parts/account.svg')}}" alt="オーナー">
                        @else
                            <img class="p-meal-show__owner__owner-row__link__img" src="{{ asset('storage/images/icons/'.$meal->user->icon)}}" alt="オーナー">
                        @endif
                        <p>&#064;{{ $meal->user->name }}</p>
                    </a>
                </div>
                @if(!empty($meal->introduction))
                    <p class="p-meal-show__owner__introduction">{{ $meal->introduction }}</p>
                @endif
            </section>

            @if(!empty($meal->shop_id))
                <section class="p-meal-show__shop">
                    <h3>店舗情報</h3>

                    <table class="p-meal-show__shop__table">
                        @if(!empty($meal->shop->name))
                            <tr class="p-meal-show__shop__table__tr">
                                <td class="p-meal-show__shop__table__tr__th">店名</td>
                                <td class="p-meal-show__shop__table__tr__td">{{ $meal->shop->name }}</td>
                            </tr>
                        @endif
                        @if(!empty($meal->shop->address))
                            <tr class="p-meal-show__shop__table__tr">
                                <td class="p-meal-show__shop__table__tr__th">住所</td>
                                <td class="p-meal-show__shop__table__tr__td">{{ $meal->shop->address }}</td>
                            </tr>
                        @endif
                        @if(!empty($meal->shop->open))
                            <tr class="p-meal-show__shop__table__tr">
                                <td class="p-meal-show__shop__table__tr__th">営業時間</td>
                                <td class="p-meal-show__shop__table__tr__td">{{ $meal->shop->open }}</td>
                            </tr>
                        @endif
                    </table>
                </section>
            @endif
        </div>
        <section class="p-meal-show__comment">
            <div class="p-meal-show__comment__header-row">
                <h3>コメント</h3>
                <img class="p-meal-show__comment__header-row__create" src="{{ asset('storage/images/parts/create.svg')}}" alt="作成" x-data="" x-on:click.prevent="$dispatch('open-modal', 'meal-comment-create-and-edit')">
            </div>
            @if(count($meal->mealComments) === 0)
                <p class="p-meal-show__comment__none">まだコメントはありません。</p>
            @else
                @foreach($meal->mealComments as $mealCommentForShow)
                    @if($loop->index === 5)
                        <div class="p-meal-show__comment__more">
                            <p class="p-meal-show__comment__more__text">コメントをもっと見る({{ count($meal->mealComments) }})</p>
                            <a class="p-meal-show__comment__more__link" href="{{route('mealComment.index', $meal)}}">
                                <img class="p-meal-show__comment__more__link__img" src="{{ asset('storage/images/parts/link.svg')}}" alt="リンク">
                            </a>
                        </div>
                        @break
                    @endif
                    <div class="p-meal-show__comment__body">
                        <div class="p-meal-show__comment__body__user-row">
                            <a class="p-meal-show__comment__body__user-row__link" href="#">
                                @if(empty($mealCommentForShow->user->icon))
                                    <img class="p-meal-show__comment__body__user-row__link__img" src="{{ asset('storage/images/parts/account.svg')}}" alt="オーナー">
                                @else
                                    <img class="p-meal-show__comment__body__user-row__link__img" src="{{ asset('storage/images/icons/'.$mealCommentForShow->user->icon)}}" alt="オーナー">
                                @endif
                                <p>&#064;{{ $mealCommentForShow->user->name }}</p>
                            </a>
                            <p>返信({{ count($mealCommentForShow->mealReplies) }}件)</p>
                        </div>
                        <div class="p-meal-show__comment__body__comment-row">
                            <p class="p-meal-show__comment__body__comment-row__text">{{ $mealCommentForShow->text }}</p>
                            <a class="p-meal-show__comment__body__comment-row__link" href="{{route('mealComment.show', $mealCommentForShow)}}">
                                <img class="p-meal-show__comment__body__comment-row__link__img" src="{{ asset('storage/images/parts/link.svg')}}" alt="リンク">
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </section>
    </div>

    @include('meal.partials.create-and-edit-modal')
    @include('meal.partials.delete-modal')
    @include('mealComment.partials.create-and-edit-modal')

    @vite(['resources/js/doms/meals/index-and-show/script.js'])
</x-app-layout>
