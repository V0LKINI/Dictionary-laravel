@extends('layouts.master')

@section('title', 'Словарик')

@section('content')
    <br>
    @if (session()->has('warning'))
        <div class="alert alert-warning" role="alert">{{ session()->get('warning') }}</div>
    @endif
    <h4 id="formName">Добавить слово</h4>
    <form id="addWordForm" method="post" style="margin-bottom: 10px" action="{{ route('word-add') }}">
        @csrf
        <input type="text" placeholder="Введите слово" name="english" id="english" value="">
        <input type="text" placeholder="Введите перевод" size="50" name="russian" id="russian" value="">
{{--        <input type="submit" class="btn btn-success" style="margin-bottom: 4px;" value="Добавить">--}}
            <input type="button" class="btn btn-success" style="margin-bottom: 4px;"
                   id="submitWordButton" onclick="addWord()" value="Добавить">
        <input type="reset" class="btn btn-danger" style="margin-bottom: 4px;"
               id="resetButton" onclick="add()" value="Сбросить">
    </form>

    <p id="errorMessage"></p>

    <table id="mainTable" class="simple-little-table">
        <tr id="tableHead">
            <th style="width: 20%;">Слово</th>
            <th style="width: 45%;">Перевод</th>
            <th style="width: 20%;">Взаимодействие</th>
            <th style="width: 15%;">Прогресс</th>
        </tr>
        @foreach($user->words as $word)
            <tr class="tableRow" id="tableRow-{{ $word->id }}">
                <td class="tableColumn">{{ $word->english }}</td>
                <td class="tableColumn">{{ $word->russian }}</td>
                <td class="tableColumn">
                    <span class="penIcon material-icons" onclick="edit({{ $word->id }})">edit</span>
                    <span class="binIcon material-icons" onclick="deleteWord({{ $word->id }})">delete</span>
                    <span class="resetIcon material-icons" onclick="resetWordProgress({{ $word->id }})">cached</span>
                </td>
                <td class="tableColumn" id="wordProgress">{{ $word->progress }}%</td>
            </tr>
        @endforeach
    </table>
@endsection
