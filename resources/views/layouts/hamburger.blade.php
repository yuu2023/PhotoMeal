<x-hamburger-modal name="hamburger">
    <div class="p-hamburger">
        <img class="p-hamburger__close" src="{{ asset('storage/images/parts/close.svg')}}" alt="閉じる" x-on:click="$dispatch('close')">
        <div class="p-hamburger__items">
            <a href="#" class="p-hamburger__items__mypage">マイページ</a>
            <a href="{{route('profile.edit')}}" class="p-hamburger__items__account">アカウント</a>
            <form class="p-hamburger__items__logout" method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{route('logout')}}" class="p-hamburger__items__logout__link" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</a>
            </form>
        </div>
    </div>
</x-modal>
