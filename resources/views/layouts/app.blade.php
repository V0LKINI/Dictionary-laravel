<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Styles -->
    <link rel="stylesheet" href="/css/header.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-color: #fcfcfc;">
<div id="app">

    <header>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ECECEC;">
            <div style="width: 1100px;" class="container-fluid">
                <a class="navbar-brand" href="{{ route('main') }}" style="font-family: Huntsman;font-size: 25px;">Cловарь</a>

                <span class="navbar-text" style="font-size: 20px;">
                    @guest
                        <a href="{{ route('login') }}">ВОЙТИ</a> | <a href="{{ route('register') }}">РЕГИСТРАЦИЯ</a>
                    @endguest
                    </span>
            </div>
        </nav>

    </header>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
