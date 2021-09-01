@extends('layouts.master')

@section('title', 'Russian-English')

@section('content')

    @foreach($wordsArray as $word)
        <div class="exerciseForm" id="word-{{ $loop->iteration }}" @if ($loop->iteration !== 1) hidden @endif>
            <h1> {{ $word['word'] }} </h1><br>
            <input class="btn btn-secondary fs-5 exerciseWordButton exerciseWordButton-{{ $loop->iteration }}"
                   type="button" name="chosenWord" value="{{ $word[0] }}"
                   onclick="submitAnswer('{{ $word['correct_translation'] }}',
                       this.value, {{ $word['id'] }}, {{ $loop->iteration }}, {{ $count }}, 'russian_english')"><br>
            <input class="btn btn-secondary fs-5 exerciseWordButton exerciseWordButton-{{ $loop->iteration }}"
                   type="button" name="chosenWord" value="{{ $word[1] }}"
                   onclick="submitAnswer('{{ $word['correct_translation'] }}',
                       this.value, {{ $word['id'] }}, {{ $loop->iteration }}, {{ $count }}, 'russian_english')"><br>
            <input class="btn btn-secondary fs-5 exerciseWordButton exerciseWordButton-{{ $loop->iteration }}"
                   type="button" name="chosenWord" value="{{ $word[2] }}"
                   onclick="submitAnswer('{{ $word['correct_translation'] }}',
                       this.value, {{ $word['id'] }}, {{ $loop->iteration }}, {{ $count }}, 'russian_english')"><br>
            <input class="btn btn-secondary fs-5 exerciseWordButton exerciseWordButton-{{ $loop->iteration }}"
                   type="button" name="chosenWord" value="{{ $word[3] }}"
                   onclick="submitAnswer('{{ $word['correct_translation'] }}',
                       this.value, {{ $word['id'] }}, {{ $loop->iteration }}, {{ $count }}, 'russian_english')"><br>
            <p class="fs-4">Слово {{ $loop->iteration }} из {{ $count }}</p>
        </div>
    @endforeach
    <div id="nextWordDiv"></div>

@endsection
