@extends('layouts.master')

@section('title', 'Antondzaki')

@section('content')

    <form id="puzzleForm" class="puzzleForm" action="{{ route('getResultsPuzzle') }}" method="post" >
        @foreach($words as $word)
            <div class="puzzle__wrapper" @if ($loop->iteration !== 1) hidden @endif>

                @csrf
                <input type="hidden" value="{{ $word['translate'] }}" name="translate">
                <input type="hidden" value="{{ $loop->iteration }}" name="index">
                <input type="hidden" value="{{ $word['id'] }}" name="words_id[]">

                <h1 class="puzzle__header">{{ $word['word'] }}</h1>
                <div class="puzzle__dropzone-wrapper">
                    @for ($i = 0; $i < $word['length']; $i++)
                        <div class="puzzle__dropzone"></div>
                    @endfor
                </div>

                <div class="puzzle__letters-wrapper">

                    @foreach($word['letters'] as $letter)
                        <div id="{{ $letter }}{{ $loop->iteration }}" class="puzzle__letter" >
                            {{ $letter }}
                        </div>
                    @endforeach
                </div>

            </div>
        @endforeach
    </form>

@endsection

@section('scripts')
    <script src="/js/exercises/puzzle.js"></script>
@endsection