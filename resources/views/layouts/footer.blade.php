@if (Auth::check())
    <footer class="l-footer">
        <div class="p-footer">
            <a href="{{route('meal.index')}}">
                <div class="p-footer__link__icon">
                    <img class="p-footer__link__icon__img" src="{{ asset('storage/images/parts/meal.svg')}}" alt="ロゴ">
                    <p class="p-footer__link__icon__text">料理</p>
                </div>
            </a>
            <a {{-- href="{{route('menu.index')}}"--}}>
                <div class="p-footer__link__icon">
                    <img class="p-footer__link__icon__img" src="{{ asset('storage/images/parts/menu.svg')}}" alt="ロゴ">
                    <p class="p-footer__link__icon__text">メニュー</p>
                </div>
            </a>
            <a {{-- href="{{route('owner.index')}}"--}}>
                <div class="p-footer__link__icon">
                    <img class="p-footer__link__icon__img" src="{{ asset('storage/images/parts/owner.svg')}}" alt="ロゴ">
                    <p class="p-footer__link__icon__text">オーナー</p>
                </div>
            </a>
            <a {{-- href="{{route('rank.index')}}"--}}>
                <div class="p-footer__link__icon">
                    <img class="p-footer__link__icon__img" src="{{ asset('storage/images/parts/rank.svg')}}" alt="ロゴ">
                    <p class="p-footer__link__icon__text">ランキング</p>
                </div>
            </a>
        </div>
    </footer>
@endif
