@extends('layouts.master')

@section('title', 'Antondzaki')

@section('content')

    <section class="promo">
        <!-- Общий контейнер -->
        <div class="swiper-container mainSlider">
            <!-- Оболочка для слайдера -->
            <div class="swiper-wrapper">

                <div class="promo__banner swiper-slide">
                    <img  class="promo-pict" src="/img/MainSlider/wall.jpg"/>
                </div>
                <div class="promo__banner swiper-slide">
                    <img  class="promo-pict" src="/img/MainSlider/scale_1200.jpg"/>
                </div>
                <div class="promo__banner swiper-slide">
                    <img  class="promo-pict" src="/img/MainSlider/girl.jpg"/>
                </div>
            </div>
        </div>

    </section>

    <section class="mainpage__news">
        <div class="mainpage__news-wrapper">
            <h2 class="mainpage__news-title">Новости</h2>

            <div class="news__block">
                <a href="{{ $news[0]->code }}" class="news__block-big">
                    <div class="news__block-big__img">
                        <img class="news__block-big__pict" src="{{ $news[0]->image }}" alt="{{ $news[0]->title }}" title="{{ $news[0]->title }}">
                        <div class="news__block-big__text">{{ $news[0]->title }}</div>
                    </div>
                </a>

                <div class="news__block-small">
                    <div class="news__block-small__wrapper">
                        <? $count=0 ?>
                        <? foreach($news as $one_news) {
                            if($count === 0){
                                $count++;
                                continue;
                              }?>
                            <a href="{{ $one_news->code }}" class="news__block-item">
                                <div class="news__block-img">
                                    <img class="news__block-pict" src="{{ $one_news->image }}" alt="{{ $one_news->title }}" title="{{ $one_news->title }}">
                                    <div class="news__block-text">{{ $one_news->title }}</div>
                                </div>
                            </a>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mainpage__about">
        <h2 class="mainpage__about-title">О нас</h2>
        <p class="mainpage__about-text">
            AntonDzaki - сервис для удобного изучение английского языка. Вы можете добавлять любое количество слов в
            ваш собственный словарь и изучать их, используя огромное количество упражнений. Доступны правила грамматики
            и возможность для их изучения, а добавление в друзья пользователей позволит соревноваться с друзьями,
            ведь так намного интересней и увлекательней!
        </p>
    </section>

@endsection

@section('scripts')
    <script src="/js/swiper-bundle_min.js"></script>
    <script src="/js/main/mainSlider.js"></script>
@endsection
