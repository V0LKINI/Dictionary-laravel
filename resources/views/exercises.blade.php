@extends('layouts.master')

@section('title', 'Упражнения')

@section('content')
<div class="card">
    <h4>English-Russian</h4>
    <p>Осталось слов: 0</p>
    <a class="exerciseLink" href="{{ route('english-russian') }}">Начать</a>
</div>

<div class="card">
    <h4>Russian-English</h4>
    <p>Осталось слов: 0</p>
    <a class="exerciseLink" href="{{ route('russian-english') }}">Начать</a>
</div>

<div class="card">
    <h4>Повторение</h4>
    <p>Всего слов: 145</p>
    <a class="exerciseLink" href="{{ route('repetition') }}">Начать</a>
</div>
@endsection
