@extends('layouts.master')

@section('title', $exerciseName)

@section('content')
    <form action="{{ route('getResultsExercise') }}" method="post" id="exerciseForm">
        @csrf
        <input type="hidden" name="exerciseName" value="{{ $exerciseName }}">
        <input type="hidden" name="count" value="{{ $count }}">
        @foreach($wordsArray as $word)
            <div class="exerciseForm" id="word-{{ $loop->iteration }}" @if ($loop->iteration !== 1) hidden @endif>
                <h1> {{ $word['word'] }} </h1>
                @for($i = 0; $i < 4; $i++)

                    <input name="word[{{ $loop->iteration }}]" type="radio" autocomplete="off" value="{{ $word[$i] }}"
                           class="btn-check" id="exerciseWordButton-{{ $loop->iteration }}-{{ $word[$i] }}"
                           onclick="checkAnswer('{{ $word['correct_translation'] }}',
                                   this.value, {{ $word['id'] }}, {{ $loop->iteration }}, {{ $count }})">

                    <label class="btn btn-secondary fs-5 exerciseWordButton checkLabel-{{ $loop->iteration }}"
                           for="exerciseWordButton-{{ $loop->iteration }}-{{ $word[$i] }}">{{ $word[$i] }}
                    </label><br>
                @endfor
                <p class="fs-4">{{__('exercises.word')}} {{ $loop->iteration }} {{__('exercises.out')}} {{ $count }}</p>
            </div>
        @endforeach
        <div id="nextWordDiv"></div>
    </form>

@endsection

@section('scripts')
    <script src="/js/exercises/exercises.js"></script>
@endsection
