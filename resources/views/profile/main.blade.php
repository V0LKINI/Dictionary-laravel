@extends('layouts.master')

@section('title', 'Профиль')

@section('content')

@if (session()->has('warning'))
    <div class="alert alert-warning" role="alert">{{ session()->get('warning') }}</div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success" role="alert">{{ session()->get('success') }}</div>
@endif

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
            <a class="accept-or-reject" href="{{ route('friends.accept', $userProfile->id) }}">Принять</a>
            <a class="accept-or-reject" href="{{ route('friends.reject', $userProfile->id) }}">Отклонить</a>
        @elseif($user->id !== $userProfile->id)
            <a href="{{ route('friends.add', $userProfile->id) }}">Добавить в друзья</a>
        @endif
    </div>


</div>

<h1 class="friends-title">Друзья</h1>

<div class="Friends-List">
    <div class="UserItemList">
        @if(!$friends->count() && $user->id === $userProfile->id)
            <p>У вас нет друзей</p>
        @elseif (!$friends->count())
            <p>У пользователя нет друзей</p>
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
                                <object>
                                  <span onclick="deleteFriend(event, {{ $friend->id }} )"
                                        class="material-icons md-24 delete-user-icon">clear</span>

                                  <form action="{{ route('friends.delete', $friend->id) }}" method="post"
                                        id="deleteFriend-{{ $friend->id }}">
                                      @csrf
                                      <input type="hidden" name="_method" value="delete" />
                                  </form>

                                </object>
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

    <div class="Friends-List">
        <div class="UserItemList">

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
                        </div>
                        <div class="UserItem-experience">
                            Опыт: {{ $friend->experience->total_experience }}
                        </div>
                        <object>
                            <a class="accept-or-reject"
                               href="{{ route('friends.accept', $friend->id) }}">Принять</a>
                            <a class="accept-or-reject"
                               href="{{ route('friends.reject', $friend->id) }}">Отклонить</a>
                        </object>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

@endif


@endsection