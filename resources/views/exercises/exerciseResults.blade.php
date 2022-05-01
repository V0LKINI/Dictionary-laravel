@extends('layouts.master')

@section('title', 'Результаты')

@section('content')
<table class="features-table">
    <thead>
    <tr>
        <td class="grey">{{__('exercises.word')}}</td>
        <td class="grey">{{__('exercises.translation')}}</td>
    </tr>
    </thead>

    <tbody>

    @foreach($results['words'] as $key=>$value)

        @if ($value[1] == true)
            <tr>
                <td class="green">{{ $key }}</td>
                <td class="green">{{ $value[0] }}</td>
            </tr>
        @else
            <tr>
                <td class="red">{{ $key }}</td>
                <td class="red">{{ $value[0] }}</td>
            </tr>
        @endif
    @endforeach
    </tbody>

    <tfoot>
    <tr>
        <td>{{ $exerciseName === 'repetition' ? __('exercises.words_repeated') : __('exercises.words_studied') }}</td>
        <td>{{ $results['rightAnswersCount'] }}</td>
    </tr>
    </tfoot>
</table>

<form action="{{ route('exercises') }}">
    <button class="btn btn-primary fs-5">{{__('exercises.back_to_exercises')}}</button>
</form>

@endsection

