<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="/scripts/jquery.js"></script>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4D4D4D;">
        <div style="width: 1100px;" class="container-fluid">
            <a class="navbar-brand" href="{{ route('main') }}" style="font-size: 20px;">Мой словарь</a>


            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" style="padding-bottom: 5px;" href="{{ route('exercises') }}" >Упражнения</a>
                </li>
            </ul>

            <span class="navbar-text" style="color: white;font-size: 20px;">
                    Привет, Kirill | Ваш опыт: 708 |<a href="/users/logout">Выйти</a>
            </span>
        </div>
    </nav>

</header>

<div id="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script  src="/scripts/words/words.js"></script>
<script  src="/scripts/ajax/word.js"></script>
</body>
</html>
