<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="/js/jquery.js"></script>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4D4D4D;">
        <div style="width: 1100px;" class="container-fluid">
            <a class="navbar-brand" href="{{ route('main') }}" style="font-family: Huntsman;font-size: 25px;">Cловарь</a>


            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" style="font-size: 16px; padding-bottom: 12px;"
                       href="{{ route('exercises') }}">УПРАЖНЕНИЯ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" style="font-size: 16px; padding-bottom: 12px;"
                       href="{{ route('leaderboard') }}">ТАБЛИЦА ЛИДЕРОВ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" style="font-size: 16px; padding-bottom: 12px;"
                       href="{{ route('admin-panel') }}">ПАНЕЛЬ АДМИНИСТРАТОРА</a>
                </li>
            </ul>

            <span class="navbar-text" style="color: white;font-size: 18px;padding-bottom: 12px;">
                @auth
                    {{ $user->name }} | Опыт: 708 | <a href="{{ route('get-logout') }}">ВЫЙТИ</a>
                @endauth
                @guest
                    <a href="{{ route('login') }}">ВОЙТИ</a> | <a href="{{ route('register') }}">РЕГИСТРАЦИЯ</a>
                @endguest
            </span>
        </div>
    </nav>

</header>

<div id="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script  src="/js/wordAjax.js"></script>
<script  src="/js/wordHelper.js"></script>
</body>
</html>
