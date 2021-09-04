@extends('layouts.master')

@section('title', 'Повторение')


@section('content')
    @foreach($words as $word)
        <div class="exerciseForm" id="word-{{ $loop->iteration }}" @if ($loop->iteration !== 1) hidden @endif>
            <h1> {{ $word['english'] }} <span hidden
                                              id="translation-{{ $loop->iteration }}">= {{ $word['russian'] }}</span>
            </h1><br>

            <input class="btn btn-success fs-5 exerciseWordButton exerciseWordButton-{{ $loop->iteration }}"
                   type="button" name="chosenWord" value="Помню"
                   onclick="submitAndNextRepetition(this.value, {{ $word['id'] }}, {{ $loop->iteration }}, {{ $count }})"><br>
            <input class="btn btn-danger fs-5 exerciseWordButton exerciseWordButton-{{ $loop->iteration }}"
                   type="button" name="chosenWord" value="Не помню"
                   onclick="submitAndNextRepetition(this.value, {{ $word['id'] }}, {{ $loop->iteration }}, {{ $count }})"><br>
            <p class="fs-4">Слово {{ $loop->iteration }} из {{ $count }}</p>
        </div>
    @endforeach
    <div id="nextWordDiv"></div>
@endsection
