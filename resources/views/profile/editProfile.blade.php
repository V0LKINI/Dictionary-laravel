@extends('layouts.master')

@section('title', 'Редактировать профиль')


@section('content')

@if ($errors->any())
    <div style="margin-top: 10px; margin-bottom: 0; padding-bottom: 0;" class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('success'))
    <div style="margin-top: 10px; margin-bottom: 0;" class="alert alert-success"
         role="alert">{{ session()->get('success') }}</div>
@endif

<form class="my-form" id="editProfileForm" action="{{ route('profile.save') }}" method="POST" enctype="multipart/form-data">
    <input name="_method" type="hidden" value="PUT">
    @csrf
    Ваше имя:<br>
    <input name="name" type="text" value="{{ $user->name }}" required><br>
    Ваш email:<br>
    <input name="email" type="email" value="{{ $user->email }}" required><br><br>

    <div id="drop-area">
        <p>Загрузите изображение с помощью кнопки или перетащив его в выделенную область</p>
        <input type="file" id="fileElem" name="image" accept="image/*" onchange="handleFiles(this.files)">
        <label class="button" for="fileElem">Выбрать фото</label>
        <div id="gallery"></div>
    </div><br>

    <input type="submit"  class="btn btn-dark" value="Сохранить">
</form>

<script src="/js/dragAndDrop.js"></script>
@endsection