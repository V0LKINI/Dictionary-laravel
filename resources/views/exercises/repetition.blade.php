@extends('layouts.master')

@section('title', 'Повторение')


@section('content')
    <form action="{{ route('getResultsRepetition') }}" method="post" id="exerciseForm">
        @csrf
        <input type="hidden" name="count" value="{{ $count }}">
        @foreach($words as $word)
            <div class="exerciseForm" id="word-{{ $loop->iteration }}" @if ($loop->iteration !== 1) hidden @endif>
                <h1> {{ $word['english'] }} <span hidden id="translation-{{ $loop->iteration }}">= {{ $word['russian'] }}</span>
                </h1><br>

                <input name="word[{{ $loop->iteration }}]" type="radio" autocomplete="off" value="Помню"
                       class="btn-check" id="exerciseWordButton-{{ $loop->iteration }}-помню"
                       onclick="checkAnswerRepetition(this.value, {{ $word['id'] }}, {{ $loop->iteration }}, {{ $count }})">
                <label class="btn btn-success fs-5 exerciseWordButton"
                       for="exerciseWordButton-{{ $loop->iteration }}-помню">Помню</label><br>

                <input name="word[{{ $loop->iteration }}]" type="radio" autocomplete="off" value="Не помню"
                       class="btn-check" id="exerciseWordButton-{{ $loop->iteration }}-не-помню"
                       onclick="checkAnswerRepetition(this.value, {{ $word['id'] }}, {{ $loop->iteration }}, {{ $count }})">
                <label class="btn btn-danger fs-5 exerciseWordButton"
                       for="exerciseWordButton-{{ $loop->iteration }}-не-помню">Не помню</label><br>
                <p class="fs-4">Слово {{ $loop->iteration }} из {{ $count }}</p>
            </div>
        @endforeach
        <div id="nextWordDiv"></div>
    </form>
@endsection
