@extends('layouts.master')

@section('title', __('exercises.title'))

@section('content')

    @if (session()->has('error'))
        <div style="margin-top: 10px; margin-bottom: 0;" class="alert alert-warning"
             role="alert">{{ session()->get('error') }}</div>
    @endif

    <div class="exercise__card-wrapper">
        <div class="exercise__card">
            <h4>{{ __('exercises.titles.russian_english') }}</h4>
            <p>{{ __('exercises.words_left') }}: {{ $wordsCount['ruEng'] }}</p>
            <a class="exerciseLink" href="{{ route('russian-english') }}">{{ __('exercises.start') }}</a>
        </div>

        <div class="exercise__card">
            <h4>{{ __('exercises.titles.english_russian') }}</h4>
            <p>{{ __('exercises.words_left') }}: {{ $wordsCount['engRu'] }}</p>
            <a class="exerciseLink" href="{{ route('english-russian') }}">{{ __('exercises.start') }}</a>
        </div>

        <div class="exercise__card">
            <h4>{{ __('exercises.titles.puzzle') }}</h4>
            <p>{{ __('exercises.words_left') }}: {{ $wordsCount['puzzle'] }}</p>
            <a class="exerciseLink" href="{{ route('puzzle') }}">{{ __('exercises.start') }}</a>
        </div>

        <div class="exercise__card">
            <h4>{{ __('exercises.titles.repetition') }}</h4>
            <p>{{ __('exercises.total_words') }}: {{ $wordsCount['repetition'] }}</p>
            <a class="exerciseLink" href="{{ route('repetition') }}">{{ __('exercises.start') }}</a>
        </div>
    </div>


@endsection


