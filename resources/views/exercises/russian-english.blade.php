@extends('layouts.master')

@section('title', 'Russian-English')

@section('content')

    @foreach($wordsArray as $word)
        <div class="exerciseForm" id="word-{{ $word['index'] }}"
             @if ($word['index'] !== 1) hidden @endif>
            <h1> {{ $word['word'] }} </h1><br>
            <input class="btn btn-secondary fs-5 exerciseWordButton exerciseWordButton-{{ $word['index'] }}"
                   type="button" name="chosenWord" value="{{ $word[0] }}"
                   onclick="submitAnswer('{{ $word['correct_translation'] }}',
                       this.value, {{ $word['id'] }}, {{ $word['index'] }}, {{ $count }}, 'russian_english')"><br>
            <input class="btn btn-secondary fs-5 exerciseWordButton exerciseWordButton-{{ $word['index'] }}"
                   type="button" name="chosenWord" value="{{ $word[1] }}"
                   onclick="submitAnswer('{{ $word['correct_translation'] }}',
                       this.value, {{ $word['id'] }}, {{ $word['index'] }}, {{ $count }}, 'russian_english')"><br>
            <input class="btn btn-secondary fs-5 exerciseWordButton exerciseWordButton-{{ $word['index'] }}"
                   type="button" name="chosenWord" value="{{ $word[2] }}"
                   onclick="submitAnswer('{{ $word['correct_translation'] }}',
                       this.value, {{ $word['id'] }}, {{ $word['index'] }}, {{ $count }}, 'russian_english')"><br>
            <input class="btn btn-secondary fs-5 exerciseWordButton exerciseWordButton-{{ $word['index'] }}"
                   type="button" name="chosenWord" value="{{ $word[3] }}"
                   onclick="submitAnswer('{{ $word['correct_translation'] }}',
                       this.value, {{ $word['id'] }}, {{ $word['index'] }}, {{ $count }}, 'russian_english')"><br>
            <p class="fs-4">Слово {{ $word['index'] }} из {{ $count }}</p>
        </div>
    @endforeach
    <div id="nextWordDiv"></div>

@endsection
