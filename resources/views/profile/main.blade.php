@extends('layouts.master')

@section('title', 'Профиль')

@section('content')


<div id="profileInfo">
    <div id="profileImage">
        @if ($userProfile->image)
            <img src="/storage{{ $userProfile->image }}" alt="Avatar">
        @else
            <img src="{{ asset('storage/avatar.png') }}" alt="Avatar">
        @endif
    </div>
    <div id="profileContent">
        <h1>
            {{ $userProfile->name }}
        </h1>
        @if ($user->isFriendWithMe($userProfile))
            <p>Пользователь у вас в друзьях</p>
        @elseif($user->hasFriendRequestPending($userProfile))
            <p>Заявка в друзья отправлена</p>
        @elseif ($user->hasFriendRequestReceived($userProfile))
            <p>Пользователь отправил вам заявку в друзья</p>
        @endif
    </div>


</div>

<h1 class="friends-title">Друзья</h1>

<div class="Friends-List">
    <div class="UserItemList">
        @if(!$friends->count())
            <p>У вас нет друзей</p>
        @else
            @foreach($friends as $friend)
                <a href="{{ route('profile.main', $friend->id) }}" class="UserItem UserItemList-item">
                    <div class="UserAvatar">
                        @if ($friend->image)
                            <img src="/storage{{ $friend->image }}" alt="Avatar">
                        @else
                            <img src="{{ asset('storage/avatar.png') }}" alt="Avatar">
                        @endif
                    </div>
                    <div class="UserItem-info">
                        <div class="UserItem-name">
                           {{ $friend->name }}
                            @if($user->id === $userProfile->id)
                                <span onclick="deleteFriend(event, {{ $friend->id }})"
                                      class="material-icons md-24 delete-user-icon">clear</span>
                            @endif
                        </div>
                        <div class="UserItem-experience">
                            <p>Опыт: {{ $friend->experience->total_experience }}</p>
                        </div>
                    </div>

                </a>
            @endforeach
        @endif
    </div>
</div>

@if($user->id === $userProfile->id AND $friendRequests->count())
    <h1 class="friends-title">Заявки в друзья</h1>

    @foreach($friendRequests as $friend)
        <a href="{{ route('profile.main', $friend->id) }}" class="UserItem UserItemList-item">
            <div class="UserAvatar">
                @if ($friend->image)
                    <img src="/storage{{ $friend->image }}" alt="Avatar">
                @else
                    <img src="{{ asset('storage/avatar.png') }}" alt="Avatar">
                @endif
            </div>
            <div class="UserItem-info">
                <div class="UserItem-name">
                    {{ $friend->name }}
                    @if($user->id === $userProfile->id)
                        <span onclick="deleteFriend(event, {{ $friend->id }})"
                              class="material-icons md-24 delete-user-icon">clear</span>
                    @endif

                </div>
                <div class="UserItem-experience">
                    <p>Опыт: {{ $friend->experience->total_experience }}</p>
                </div>
            </div>
        </a>
    @endforeach
@endif


@endsection