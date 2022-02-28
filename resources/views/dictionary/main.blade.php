@extends('layouts.master')

@section('title', 'Словарик')

@section('content')
    @if (session()->has('warning'))
        <div class="alert alert-warning" role="alert">{{ session()->get('warning') }}</div>
    @endif

    <h4 id="formName">Добавить слово</h4>
    <form id="addWordForm">
        @csrf
        <input type="text" placeholder="Введите слово" name="english"  value="">
        <input type="text" placeholder="Введите перевод" size="50" name="russian"  value="">
        <input id="addButton" class="btn btn-success mainFormButton" type="button" value="Добавить">
        <input id="editButton" class="btn btn-success mainFormButton" style="display: none;" type="button" value="Изменить">
        <input id="resetButton" class="btn btn-danger mainFormButton"  type="reset" value="Сбросить">
    </form>

    <p id="errorMessage"></p>

    <table class="simple-little-table">
        <tr id="tableHead">
            <th style="width: 20%;">Слово</th>
            <th style="width: 45%;">Перевод</th>
            <th style="width: 20%;">Взаимодействие</th>
            <th style="width: 15%;">Прогресс</th>
        </tr>
        @foreach($words as $word)
            <tr class="tableRow" id="tableRow-{{ $word->id }}">
                <td class="tableColumn">{{ $word->english }}</td>
                <td class="tableColumn">{{ $word->russian }}</td>
                <td class="tableColumn">
                    <span class="penIcon material-icons">edit</span>
                    <span class="binIcon material-icons">delete</span>
                    <span class="resetIcon material-icons">cached</span>
                </td>
                <td class="tableColumn" id="wordProgress">{{ $word->exercise->getProgress() }}%</td>
            </tr>
        @endforeach
    </table>
@endsection

@section('scripts')
    <script src="/js/dictionary/script.js"></script>
@endsection
