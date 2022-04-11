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


    @if($news->count())
    <section class="mainpage__news">
        <div class="mainpage__news-wrapper">
            <h2 class="mainpage__news-title title">Новости</h2>

            <div class="news__block">
                <a href="{{ route('news-detail', $news[0]->id) }}" class="news__block-big">
                    <div class="news__block-big__img">
                        <img class="news__block-big__pict" src="{{ Storage::url($news[0]->image) }}" alt="{{ $news[0]->title }}" title="{{ $news[0]->title }}">
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
                            <a href="{{ route('news-detail', $one_news)}}" class="news__block-item">
                                <div class="news__block-img">
                                    <img class="news__block-pict" src="{{ Storage::url( $one_news->image) }}" alt="{{ $one_news->title }}" title="{{ $one_news->title }}">
                                    <div class="news__block-text">{{ $one_news->title }}</div>
                                </div>
                            </a>
                        <? } ?>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @endif


    <section class="mainpage__about">
        <h2 class="mainpage__about-title title">О нас</h2>
        <div class="mainpage__about-bottom">
            <p class="description_sm">
                Volkoff - веб-сервис для удобного изучение английского языка, который развивается невероятными темпами!
                Уже сейчас вы можете добавлять негограниченное количество слов в
                ваш собственный словарь и изучать их, используя огромное количество упражнений. Доступны правила грамматики
                и возможность для их изучения, а добавление в друзья пользователей позволит соревноваться с друзьями,
                ведь так намного интересней и увлекательней!
            </p>
            <img src="/img/about.jpg" alt="">
        </div>
       
    </section>

@endsection

@section('scripts')
    <script src="/js/swiper-bundle_min.js"></script>
    <script src="/js/main/mainSlider.js"></script>
@endsection
