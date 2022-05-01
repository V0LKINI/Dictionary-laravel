@extends('layouts.master')

@section('title', __('profile.edit_title'))


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
    {{__('profile.edit.your_name')}}:<br>
    <input name="name" type="text" value="{{ $user->name }}" required><br>
    {{__('profile.edit.your_email')}}:<br>
    <input name="email" type="email" value="{{ $user->email }}" required><br><br>

    <div id="drop-area">
        <p>{{__('profile.edit.load_img')}}</p>
        <input type="file" id="fileElem" name="image" accept="image/*" onchange="handleFiles(this.files)">
        <label class="button" for="fileElem">{{__('profile.edit.choose_img')}}</label>
        <div id="gallery"></div>
    </div><br>

    <input type="submit"  class="btn btn-dark" value="{{__('profile.edit.save')}}">
</form>

<script src="/js/dragAndDrop.js"></script>
@endsection
