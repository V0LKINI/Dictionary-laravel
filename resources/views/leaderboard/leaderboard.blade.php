@extends('layouts.master')

@section('title', 'Словарик')

@section('content')

<table class="table_sort">
    <thead>
        <tr>
            <th>Рейтинг</th>
            <th>Имя</th>
            <th>Опыт за день</th>
            <th>Опыт за неделю</th>
            <th>Опыт за месяц</th>
            <th>Всего опыта</th>
        </tr>
    </thead>
    <tbody>
   @foreach($userRatingList as $experienceRow)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $experienceRow->user->name }}</td>
        <td>{{  $experienceRow->daily_experience }}</td>
        <td>{{  $experienceRow->weekly_experience }}</td>
        <td>{{  $experienceRow->monthly_experience }}</td>
        <td><b>{{ $experienceRow->total_experience }}</b></td>
    </tr>
    @endforeach
    </tbody>
</table>

@endsection
