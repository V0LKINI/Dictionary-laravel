@extends('layouts.admin-master')

@section('title', 'Панель администратора')

@section('content')

<input type="checkbox" id="nav-toggle" hidden checked>

<nav class="nav">
    <label for="nav-toggle" class="nav-toggle" onclick></label>

    <ul>
        <li class="admin__menu-back"><a href="/">Вернуться к сайту</a>
        <li class="admin__menu-item" data-sectionId="usersSection"><a href="#">Пользователи</a>
        <li class="admin__menu-item" data-sectionId="newsSection"><a href="#">Новости</a>
        <li class="admin__menu-item" data-sectionId="grammarSection"><a href="#">Грамматика</a>
        <li class="admin__menu-item" data-sectionId="resetExperienceSection"><a href="#">Сброс опыта</a>
    </ul>

    <div class="mask-content"></div>
</nav>

<main class="admin__main" role="main" >

    @include('admin.usersSection')

    @include('admin.newsSection')

    @include('admin.grammarSection')

    @include('admin.resetExperienceSection')


</main>

@endsection
