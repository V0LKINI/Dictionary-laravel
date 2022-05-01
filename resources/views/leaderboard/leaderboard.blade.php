@extends('layouts.master')

@section('title', __('leaderboard.title'))

@section('content')

<table class="table_sort">
    <thead>
        <tr>
            <th>{{ __('leaderboard.table.rating') }}</th>
            <th>{{ __('leaderboard.table.name') }}</th>
            <th>{{ __('leaderboard.table.daily') }}</th>
            <th>{{ __('leaderboard.table.weekly') }}</th>
            <th>{{ __('leaderboard.table.monthly') }}</th>
            <th>{{ __('leaderboard.table.total') }}</th>
        </tr>
    </thead>
    <tbody>
   @foreach($userRatingList as $experienceRow)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td><a href="{{ route('profile.main', $experienceRow->user->id) }}">{{ $experienceRow->user->name }}</a></td>
        <td>{{  $experienceRow->daily_experience }}</td>
        <td>{{  $experienceRow->weekly_experience }}</td>
        <td>{{  $experienceRow->monthly_experience }}</td>
        <td><b>{{ $experienceRow->total_experience }}</b></td>
    </tr>
    @endforeach
    </tbody>
</table>

@endsection

@section('scripts')
    <script src="/js/leaderboard/tableSort.js"></script>
@endsection
