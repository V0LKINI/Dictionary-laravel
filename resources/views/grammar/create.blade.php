@extends('layouts.admin-master')

@section('title', 'Добавить правило')

@section('content')

<div class="admin__news-form-wrapper">
    <h2>Добавить правило</h2>

    @foreach ($errors->all() as $message)
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @endforeach

    <form action="{{ route('grammar.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="admin__input-wrapper">
            <input class="admin__input" type="text" name="name" placeholder="Title" value="{{ old('name')}}">
        </div>
        <div class="admin__input-wrapper">
            <select class="admin__input" name="level">
                <option value="basic">Basic</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
        </div>
        <div class="admin__input-wrapper">
            <textarea class="admin__input admin__textarea" name="description" placeholder="Description">{{ old('description') ??
'<div class="rules__title">

</div>
<div class="rules__text">

</div>'}}
            </textarea>
        </div>

        <div>
            <input class="admin__button button-success" type="submit" value="Добавить">
            <a class="admin__button button-danger" href="{{ route('admin') }}">Отмена</a>
        </div>
    </form>

</div>

@endsection

@section('scripts')
    <script src="/js/admin/script.js"></script>
@endsection