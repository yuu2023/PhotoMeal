<x-app-layout>
    @if (session('status') === 'user-store')
        <x-message>
            アカウントを作成しました。
        </x-message>
    @endif
    @if (session('status') === 'meal-destroy')
        <x-message>
            料理を削除しました。
        </x-message>
    @endif
    <div class="p-meal-index">
        <section class="l-wrapper-no-padding-y p-meal-index__common">
            @include('meal.partials.index-common')
        </section>
        @if($mode === 'grid')
            <section class="l-wrapper-no-padding-y p-meal-index__grid">
                @include('meal.partials.index-grid')
            </section>
        @elseif($mode === 'detail')
            <section class="p-meal-index__detail">
                @include('meal.partials.index-detail')
            </section>
        @elseif($mode === 'map')
            <section class="l-wrapper-no-padding-y p-meal-index__map">
                @include('meal.partials.index-map')
            </section>
        @else
            <section class="l-wrapper-no-padding-y p-meal-index__grid">
                @include('meal.partials.index-grid')
            </section>
        @endif

        <section class="p-meal-index__pages">
            {{$meals->links()}}
        </section>
    </div>
</x-app-layout>
