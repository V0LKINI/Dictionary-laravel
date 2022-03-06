@extends('layouts.master')

@section('title', 'Словарик')

@section('content')
    <div class="dictionary-wrapper">

        @if (session()->has('warning'))
            <div class="alert alert-warning" role="alert">{{ session()->get('warning') }}</div>
        @endif

        <h4 id="formName" class="formName">Добавить слово</h4>

        <form id="addWordForm" class="wrapper">
             @csrf

            <!--  Regular text input  -->
            <div id="englishInputWrapper" class="form-input">
                <input id="english" class="form-element-input" type="text" name="english" placeholder="Введите слово" autocomplete="off" value=''/>
                <div class="form-element-bar"></div>
                <label class="form-element-label" for="english">Слово</label>
                <small class="form-element-hint"></small>
            </div>

            <!--  Text input with an error  -->
            <div id="russianInputWrapper" class="form-input">
                <input id="russian" class="form-element-input" type="text" placeholder="Введите перевод" name="russian" autocomplete="off" value=''/>
                <div class="form-element-bar"></div>
                <label class="form-element-label" for="russian">Перевод</label>
                <small class="form-element-hint"></small>
            </div>

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

    </div>
@endsection

@section('scripts')
    <script src="/js/dictionary/script.js"></script>
@endsection
