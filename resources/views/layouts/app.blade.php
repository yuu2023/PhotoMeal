<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/> --}}

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/scss/style.css', 'resources/js/app.js', 'resources/js/doms/commons/script'])
    </head>
    <body>
        <img class="p-knife" src="{{ asset('storage/images/parts/knife.svg')}}" alt="ナイフ" id="knife">
        <img class="p-fork" src="{{ asset('storage/images/parts/fork.svg')}}" alt="フォーク" id="fork">

        <div class="l-container" id="container">
            @if (session('status') === 'login')
                <x-message>
                    ログインしました。
                </x-message>
            @endif

            @include('layouts.header')

            <!-- Page Content -->
            <main class="l-main" id="main">
                {{ $slot }}
            </main>

            @include('layouts.footer')
        </div>
    </body>
</html>
