@extends('master')

@section('title', 'Упражнения')

@section('content')
<div class="card">
    <h4>Слово-Перевод</h4>
    <p>Осталось слов: 0</p>
    <a class="exerciseLink" href="/exercises/wordtranslations">Начать</a>
</div>

<div class="card">
    <h4>Перевод-cлово</h4>
    <p>Осталось слов: 0</p>
    <a class="exerciseLink" href="/exercises/translationwords">Начать</a>
</div>

<div class="card">
    <h4>Повторение</h4>
    <p>Всего слов: 145</p>
    <a class="exerciseLink" href="/exercises/repetition">Начать</a>
</div>
@endsection
