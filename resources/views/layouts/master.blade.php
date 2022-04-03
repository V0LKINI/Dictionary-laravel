<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/toasts.css">
    <link rel="stylesheet" href="/css/swiper-bundle_min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="/js/jquery.js"></script>


</head>
<body class="hero-anime {{ isset($user) && $user->is_dark_theme ? 'dark' : '' }}">

    <div class="navigation-wrap bg-light start-header start-style">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-md navbar-light">

                        <a class="navbar-brand" href="/">
{{--                            <img src="https://assets.codepen.io/1462889/fcy.png" alt="">--}}
                            VOLKOFF
                        </a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto py-4 py-md-0">

                                @auth
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="{{ route('dictionary') }}">Dictionary</a>
                                </li>
                                @endauth
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="{{ route('grammar') }}">Grammar</a>
                                </li>
                                @auth
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="{{ route('exercises') }}" role="button">Training</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('russian-english') }}">Russian-English</a>
                                        <a class="dropdown-item" href="{{ route('english-russian') }}">English-Russian</a>
                                        <a class="dropdown-item" href="{{ route('puzzle') }}">Puzzle</a>
                                        <a class="dropdown-item" href="{{ route('repetition') }}">Повторение</a>
                                    </div>
                                </li>
                                @endauth
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="{{ route('leaderboard') }}">Leaderboard</a>
                                </li>

                                @if (isset($user) && $user->isAdmin())
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="{{ route('admin') }}">Admin Panel</a>
                                </li>
                                @endif

                            </ul>
                        </div>

                        @auth
                            <span class="navbar-text">
                                {{ $user->name}} | Опыт: <span id="userExperience">{{ $user->experience->total_experience }}</span>
                            </span>
                            <div class="dropdown">
                                @if ($user->image)
                                    <img src="{{ Storage::url($user->image)}}"
                                         alt="Avatar" class="avatar dropbtn" onclick="dropDownFunction()">
                                @else
                                    <img src="{{ Storage::url('avatar.png')}}"
                                         alt="Avatar" class="avatar dropbtn" onclick="dropDownFunction()">
                                @endif

                                <div id="myDropdown" class="dropdown-content">
                                    <a href="{{ route('profile.main', $user->id) }}">Профиль</a>
                                    <a href="{{ route('profile.edit') }}">Редактировать</a>
                                    <a href="{{ route('get-logout') }}">Выйти</a>
                                    <div id="switch"><div id="circle"></div> </div>
                                </div>
                            </div>


                            <span class="material-icons dropbtn" onclick="dropDownFunction()">arrow_drop_down</span>

                        @endauth
                        @guest
                            <span class="navbar-text">
                                <a href="{{ route('login') }}">ВОЙТИ</a> | <a href="{{ route('register') }}">РЕГИСТРАЦИЯ</a>
                            </span>
                        @endguest


                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <footer class="footer">
        <div class="wrapper">
            <div class="footer__menu">

                <nav class="footer__nav">
                    <ul class="header__list">

                        @auth
                            <li class="footer__item">
                                <a class="footer__link" href="{{ route('dictionary') }}">Dictionary</a>
                            </li>
                        @endauth
                        <li class="footer__item">
                            <a class="footer__link" href="{{ route('grammar') }}">Grammar</a>
                        </li>
                        @auth
                            <li class="footer__item">
                                <a class="footer__link" href="{{ route('exercises') }}">Training</a>
                            </li>
                        @endauth
                        <li class="footer__item">
                            <a class="footer__link" href="{{ route('leaderboard') }}">Leaderboard</a>
                        </li>

                        @if (isset($user) && $user->isAdmin())
                            <li class="footer__item">
                                <a class="footer__link" href="{{ route('admin') }}">Admin Panel</a>
                            </li>
                        @endif
                    </ul>
                </nav>

                <button class="footer__btn">
                    Наверх
                    <span>
                        <svg width="17" height="14" viewBox="0 0 17 14" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.5 1L15.5 7M15.5 7L9.5 13M15.5 7L-2.62268e-07 7" stroke="#53627E"/>
                        </svg>
                    </span>
                </button>
            </div>
            <div class="footer__contacts">

                <div class="footer__socials">
                    <a class="footer__socials-item" rel="nofollow" href="https://www.facebook.com/vo1kov.k/" target="_blank" title="Facebook">
                        <svg>
                            <use xlink:href="/img/sprite.svg#fb-usage"></use>
                        </svg></a>
                    <a class="footer__socials-item" rel="nofollow" href="https://www.instagram.com/vo1kov.k/" target="_blank" title="Instagram">
                        <svg>
                            <use xlink:href="/img/sprite.svg#insta-usage"></use>
                        </svg></a>
                    <a class="footer__socials-item" rel="nofollow" href="https://vk.com/vo1kov_kirill" target="_blank" title="VK">
                        <svg>
                            <use xlink:href="/img/sprite.svg#vk-usage"></use>
                        </svg></a>
                    <a class="footer__socials-item" rel="nofollow" href="https://www.youtube.com/channel/UC8ZldNm1HU0p7pTdIgFWQMg" target="_blank" title="Youtube">
                        <svg>
                            <use xlink:href="/img/sprite.svg#youtube-usage"></use>
                        </svg></a>
                    <a class="footer__socials-item" rel="nofollow" href="https://t.me/V0LKINI" target="_blank" title="Telegram">
                        <svg>
                            <use xlink:href="/img/sprite.svg#telegram-usage"></use>
                        </svg></a>

                    <a class="footer__phone" href="tel:+79231748399">+7 (923) 174-83-99</a>
                </div>



                <div class="footer__email">
                    По вопросам и предложениям <a href="mailto:support@dragonleague.info">k.volkov.n@gmail.com</a>
                </div>
            </div>
            <div class="footer__copyright">
                <div class="footer__copyright-item">Copyright ©2021-<?=date("Y")?> Volkoff</div>
                <a href="#" class="footer__dev">Разработано в Volkoff</a>
            </div>
        </div>
    </footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
<script src="/js/toast.js"></script>
<script src="/js/dropDownMenu.js"></script>
<script src="/js/friends/friends.js"></script>
<script src="/js/header.js"></script>

@yield('scripts')

</body>
</html>
