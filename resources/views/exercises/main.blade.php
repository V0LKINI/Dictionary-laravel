@extends('layouts.master')

@section('title', 'Упражнения')

@section('content')

    @if (session()->has('error'))
        <div style="margin-top: 10px; margin-bottom: 0;" class="alert alert-warning"
             role="alert">{{ session()->get('error') }}</div>
    @endif

    <div class="exercise__card">
        <h4>Russian-English</h4>
        <p>Осталось слов: {{ $wordsCount['ruEng'] }}</p>
        <a class="exerciseLink" href="{{ route('russian-english') }}">Начать</a>
    </div>

    <div class="exercise__card">
        <h4>English-Russian</h4>
        <p>Осталось слов: {{ $wordsCount['engRu'] }}</p>
        <a class="exerciseLink" href="{{ route('english-russian') }}">Начать</a>
    </div>

    <div class="exercise__card">
        <h4>Puzzle</h4>
        <p>Всего слов: {{ $wordsCount['puzzle'] }}</p>
        <a class="exerciseLink" href="{{ route('puzzle') }}">Начать</a>
    </div>

    <div class="exercise__card">
        <h4>Повторение</h4>
        <p>Всего слов: {{ $wordsCount['repetition'] }}</p>
        <a class="exerciseLink" href="{{ route('repetition') }}">Начать</a>
    </div>

@endsection


