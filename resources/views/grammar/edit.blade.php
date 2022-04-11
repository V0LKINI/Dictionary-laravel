@extends('layouts.admin-master')

@section('title', 'Редактировать правило')

@section('content')

<div class="admin__news-form-wrapper">
    <h2 id="formHead">Редактировать правило</h2>

    @foreach ($errors->all() as $message)
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @endforeach

    <form id="newsForm" action="{{ route('grammar.update', $grammar) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="admin__input-wrapper">
            <input class="admin__input" type="text" name="name" placeholder="Title" value="{{ old('title')??$grammar->name }}">
        </div>
        <div class="admin__input-wrapper">
            <select class="admin__input" name="level">
                <option {{ $grammar->level == 'basic' ? 'selected':'' }} value="basic">Basic</option>
                <option {{ $grammar->level == 'intermediate' ? 'selected':'' }} value="intermediate">Intermediate</option>
                <option {{ $grammar->level == 'advanced' ? 'selected':'' }} value="advanced">Advanced</option>
            </select>
        </div>
        <div class="admin__input-wrapper">
            <textarea class="admin__input admin__textarea" name="description" placeholder="Description">{{ old('description')??$grammar->description }}</textarea>
        </div>
        <div class="admin__news-buttonsWrapper">
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