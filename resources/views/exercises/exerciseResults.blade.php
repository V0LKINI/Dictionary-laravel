@extends('layouts.master')

@section('title', 'Russian-English')

@section('content')
<table class="features-table">
    <thead>
    <tr>
        <td class="grey">Слово</td>
        <td class="grey">Перевод</td>
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
        <td>{{ $exerciseName === 'repetition' ? 'Слов повторено:' : 'Слов изучено:' }}</td>
        <td>{{ $results['rightAnsersCount'] }}</td>
    </tr>
    </tfoot>
</table>

<form action="{{ route('exercises') }}">
    <button class="btn btn-primary fs-5">Вернуться к упражнениям</button>
</form>

@endsection

