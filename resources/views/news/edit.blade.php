@extends('layouts.admin-master')

@section('title', 'Редактировать новость')

@section('content')

<div class="admin__news-form-wrapper">
    <h2 id="formHead">Редактировать новость</h2>
    <form id="newsForm" action="{{ route('news.update', $news->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="admin__input-wrapper">
            <input id="news_title" class="admin__input" type="text" name="title" placeholder="Title" value="{{ $news->title }}">
        </div>
        <div class="admin__input-wrapper">
            <input id="news_code" class="admin__input" type="text" name="code" placeholder="Code"  value="{{ $news->code }}">
        </div>
        <div class="admin__input-wrapper">
            <textarea id="news_description" class="admin__input admin__textarea" name="description" placeholder="Description"> {{ $news->description }}</textarea>
        </div>
        <div class="admin__news-buttonsWrapper">
            <div class="admin__button-wrapper">
                <input type="file" name="image" accept="image/*">
            </div>

            <div>
                <input id="newsSubmitBtn" class="admin__button button-success" type="submit" value="Сохранить">
                <a class="admin__button button-danger" href="{{ route('admin') }}">Отмена</a>
            </div>
        </div>


    </form>
</div>
@endsection

@section('scripts')
    <script src="/js/admin/script.js"></script>
@endsection