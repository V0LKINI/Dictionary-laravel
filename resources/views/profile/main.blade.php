@extends('layouts.master')

@section('title', 'Профиль')


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

<div id="editProfileForm">
    <form action="{{ route('profile.edit') }}" method="POST" enctype="multipart/form-data">
        <input name="_method" type="hidden" value="PUT">
        @csrf
        Ваше имя:
        <input name="name" type="text" value="{{ $user->name }}"><br><br>
        Ваш email:
        <input name="email" type="text" value="{{ $user->email }}"><br><br>
        <input name="image" type="file"><br><br>
        <input type="submit" value="Сохранить">
    </form>
</div>

@endsection