@extends('layouts.master')
@section('content')
    <br>
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
