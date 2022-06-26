@extends('layouts.master')

@section('title', $news->title)

@section('content')

<section class="details">
    <div class="wrapper">

        <div class="details__inner">
            <div class="details__news">

                <h3 class="details__news-subtitle">{{$news->__('title')}}</h3>

                <div class="details__news-text">
                    {{$news->__('description')}}

                  <div class="details__news-img">
                    <img class="details__news-pict"
                    src="{{ Storage::url($news->image) }}"
                    alt="{{$news->__('title')}}"
                    title="{{$news->__('title')}}">
                  </div>

                </div>

            </div>

            <div class="details__other">
                <h3 class="details__news-subtitle">Ещё новости:</h3>
                @foreach ($otherNews as $one_news)
                    <a href="{{ route('news-detail', $one_news->id )}}" class="details__other-link">
                        <p>{{ $one_news->__('title') }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
