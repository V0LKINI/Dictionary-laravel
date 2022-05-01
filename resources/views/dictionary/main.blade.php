@extends('layouts.master')

@section('title', __('dictionary.title'))

@section('content')
    <div class="dictionary-wrapper">

        @if (session()->has('warning'))
            <div class="alert alert-warning" role="alert">{{ session()->get('warning') }}</div>
        @endif

        <h4 id="formNameAdd" class="formName">{{ __('dictionary.add_word') }}</h4>
        <h4 id="formNameEdit" hidden class="formName">{{ __('dictionary.edit_word') }}</h4>

        <form id="addWordForm" class="wrapper">
             @csrf

            <!--  Regular text input  -->
            <div id="englishInputWrapper" class="form-input">
                <input id="english" class="form-element-input" type="text" name="english" placeholder="{{__('dictionary.placeholder_word')}}" autocomplete="off" value=''/>
                <div class="form-element-bar"></div>
                <label class="form-element-label" for="english">{{ __('dictionary.table.word') }}</label>
                <small class="form-element-hint"></small>
            </div>

            <!--  Text input with an error  -->
            <div id="russianInputWrapper" class="form-input">
                <input id="russian" class="form-element-input" type="text" placeholder="{{__('dictionary.placeholder_translation')}}" name="russian" autocomplete="off" value=''/>
                <div class="form-element-bar"></div>
                <label class="form-element-label" for="russian">{{ __('dictionary.table.translation') }}</label>
                <small class="form-element-hint"></small>
            </div>

             <input id="addButton" class="btn btn-success mainFormButton" type="button" value="{{__('dictionary.add_button')}}">
             <input id="editButton" class="btn btn-success mainFormButton" style="display: none;" type="button" value="{{__('dictionary.edit_button')}}">
             <input id="resetButton" class="btn btn-danger mainFormButton"  type="reset" value="{{__('dictionary.reset_button')}}">

        </form>

        <p id="errorMessage"></p>

        <div class="dictionary__table-wrapper">
            <table class="simple-little-table">
                <tr id="tableHead">
                    <th style="width: 20%;">{{ __('dictionary.table.word') }}</th>
                    <th style="width: 45%;">{{ __('dictionary.table.translation') }}</th>
                    <th style="width: 20%;">{{ __('dictionary.table.interaction') }}</th>
                    <th style="width: 15%;">{{ __('dictionary.table.progress') }}</th>
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


    </div>
@endsection

@section('scripts')
    <script src="/js/dictionary/script.js"></script>
@endsection
