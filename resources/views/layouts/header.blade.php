<header class="l-header">
    <div class="p-header">
        <div class="p-header__logo">
            <img class="p-header__logo__img" src="{{ asset('storage/images/parts/yummy.svg')}}" alt="ロゴ">
            <h1 class="p-header__logo__text">ふぉとミール！</h1>
        </div>
        @if (Auth::check())
            @if(Auth::user()->icon)
                <img class="p-header__user-icon" src="{{ asset('storage/images/icons/'.Auth::user()->icon)}}" alt="アカウント" x-data="" x-on:click.prevent="$dispatch('open-modal', 'hamburger')">
            @else
                <img class="p-header__user-icon" src="{{ asset('storage/images/parts/account.svg')}}" alt="アカウント" x-data="" x-on:click.prevent="$dispatch('open-modal', 'hamburger')">
            @endif
        @endif
    </div>
</header>

@include('layouts.hamburger')
