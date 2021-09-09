<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/toasts.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="/js/jquery.js"></script>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4D4D4D;">
        <div style="width: 1100px;" class="container-fluid">
            <a class="navbar-brand" href="{{ route('main') }}"
               style="font-family: Huntsman;font-size: 25px;">Cловарь</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" style="font-size: 16px; padding-bottom: 12px;"
                           href="{{ route('exercises') }}">УПРАЖНЕНИЯ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" style="font-size: 16px; padding-bottom: 12px;"
                           href="{{ route('leaderboard') }}">ТАБЛИЦА ЛИДЕРОВ</a>
                    </li>
                    @if ($user->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link active" style="font-size: 16px; padding-bottom: 12px;"
                               href="{{ route('admin') }}">ПАНЕЛЬ АДМИНИСТРАТОРА</a>
                        </li>
                    @endif
                </ul>

                    @auth
                        <span id="nameAndExperienceSpan" class="navbar-text">
                            {{ $user->name}} | Опыт: <span id="userExperience">{{ $user->experience->total_experience }}</span>
                        </span>
                        <div class="dropdown">
                            @if ($user->image)
                                <img src="/storage{{ $user->image }}"
                                     alt="Avatar" class="avatar dropbtn" onclick="myFunction()">
                            @else
                                <img src="{{ asset('storage/avatar.png') }}"
                                     alt="Avatar" class="avatar dropbtn" onclick="myFunction()">
                            @endif
                            <div id="myDropdown" class="dropdown-content">
                                <a href="{{ route('profile.main') }}">Профиль</a>
                                <a href="">Друзья</a>
                                <a href="{{ route('get-logout') }}">Выйти</a>
                            </div>
                        </div>

                    @endauth
                    @guest
                        <span class="navbar-text" style="color: white;font-size: 18px;padding-bottom: 10px;">
                            <a href="{{ route('login') }}">ВОЙТИ</a> | <a href="{{ route('register') }}">РЕГИСТРАЦИЯ</a>
                        </span>
                    @endguest
                </span>
            </div>

        </div>
    </nav>

</header>

<div id="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
<script src="/js/toast.js"></script>
<script src="/js/dropDownMenu.js"></script>
<script src="/js/dragAndDrop.js"></script>
<script src="/js/words/wordAjax.js"></script>
<script src="/js/words/wordHelper.js"></script>
<script src="/js/exercises/ruEng-engRu.js"></script>
<script src="/js/exercises/repetition.js"></script>
<script src="/js/exercises/exerciseHelper.js"></script>
<script src="/js/leaderboard/tableSort.js"></script>
</body>
</html>
