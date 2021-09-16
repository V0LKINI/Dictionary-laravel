@extends('layouts.master')

@section('title', 'Панель администратора')

@section('content')

@if (session()->has('success'))
    <br>
    <div class="alert alert-success" role="alert">{{ session()->get('success') }}</div>
@endif

@if($user->isAdmin())
    <div id="resetExperienceButtons">
        <form action="{{ route('resetDaily') }}" method="post">
            @csrf
            <input name="_method" type="hidden" value="PUT">
            <input class="btn btn-danger" type="submit" value="Сбросить ежедневный опыт">
        </form>

        <form action="{{ route('resetWeekly') }}" method="post">
            @csrf
            <input name="_method" type="hidden" value="PUT">
            <input class="btn btn-danger" type="submit" value="Сбросить недельный опыт">
        </form>

        <form action="{{ route('resetMonthly') }}" method="post">
            @csrf
            <input name="_method" type="hidden" value="PUT">
            <input class="btn btn-danger" type="submit" value="Сбросить месячный опыт">
        </form>
    </div>
@endif
<table class="simple-little-table">
    <tr>
        <th style="width: 10%;">id</th>
        <th style="width: 20%;">Имя</th>
        <th style="width: 30%;">Email</th>
        <th style="width: 40%;">Зарегистрирован</th>
    </tr>
    @foreach($allUsers as $oneUser)
        <tr class="tableRow" id="usersTableRow-{{ $oneUser->id }}">
            <td class="tableColumn">{{ $oneUser->id }}</td>
            <td class="tableColumn">{{ $oneUser->name }}</td>
            <td class="tableColumn">{{ $oneUser->email }}</td>
            <td class="tableColumn">{{ $oneUser->created_at }}</td>
        </tr>
    @endforeach
</table>
@endsection
