@extends('layouts.master')

@section('title', __('profile.title'))

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
            <img src="{{ Storage::url($userProfile->image)}}" alt="Avatar">
        @else
            <img src="{{ Storage::url('avatar.png')}}" alt="Avatar">
        @endif
    </div>
    <div id="profileContent">
        <h1>
            {{ $userProfile->name }}
        </h1>
        @if ($user->isFriendWithMe($userProfile))
            <p>{{__('profile.user_is_friend')}}</p>
        @elseif($user->hasFriendRequestPending($userProfile))
            <p>{{__('profile.application_to_friends_send')}}</p>
        @elseif ($user->hasFriendRequestReceived($userProfile))
            <p>{{__('profile.application_to_friends_came')}}</p>
            <a class="accept-or-reject" href="{{ route('friends.accept', $userProfile->id) }}">{{__('profile.accept')}}</a>
            <a class="accept-or-reject" href="{{ route('friends.reject', $userProfile->id) }}">{{__('profile.reject')}}</a>
        @elseif($user->id !== $userProfile->id)
            <a href="{{ route('friends.add', $userProfile->id) }}">{{__('profile.add_to_friend')}}</a>
        @endif
    </div>


</div>

<h1 class="friends-title">{{__('profile.friends')}}</h1>

<form action="{{ route('profile.search') }}" method='GET'>
    <input type="search" name="query" placeholder="{{__('profile.who_is_searching')}}">
    <input type="submit" value="{{__('profile.search')}}">
</form>

<br>

<div class="Friends-List">
    <div class="UserItemList">
        @if(!$friends->count() && $user->id === $userProfile->id)
            <p>{{__('profile.you_dont_have_friends')}}</p>
        @elseif (!$friends->count())
            <p>{{__('profile.user_doest_have_friends')}}</p>
        @else
            @foreach($friends as $friend)
                <a href="{{ route('profile.main', $friend->id) }}" class="UserItem UserItemList-item">
                    <div class="UserAvatar">
                        @if ($friend->image)
                            <img src="{{ Storage::url($friend->image)}}" alt="Avatar">
                        @else
                            <img src="{{ Storage::url('avatar.png')}}" alt="Avatar">
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
                            <p>{{__('profile.experience')}}: {{ $friend->experience->total_experience }}</p>
                        </div>
                    </div>

                </a>
            @endforeach
        @endif
    </div>
</div>

@if($user->id === $userProfile->id AND ($friendRequests->count() OR $friendsPending->count()))
    <h1 class="friends-requests">{{__('profile.friends_requests')}}</h1>

    @if($friendRequests->count())
        <p class="friends-requests-title">{{__('profile.incoming')}}</p>
        <div class="Friends-List">
            <div class="UserItemList">

                @foreach($friendRequests as $friend)
                    <a href="{{ route('profile.main', $friend->id) }}" class="UserItem UserItemList-item">
                        <div class="UserAvatar">
                            @if ($friend->image)
                                <img src="{{ Storage::url($friend->image)}}" alt="Avatar">
                            @else
                                <img src="{{ Storage::url('avatar.png')}}" alt="Avatar">
                            @endif
                        </div>
                        <div class="UserItem-info">
                            <div class="UserItem-name">
                                {{ $friend->name }}
                            </div>
                            <div class="UserItem-experience">
                                {{__('profile.experience')}}: {{ $friend->experience->total_experience }}
                            </div>
                            <object>
                                <a class="accept-or-reject"
                                   href="{{ route('friends.accept', $friend->id) }}">{{__('profile.accept')}}</a>
                                <a class="accept-or-reject"
                                   href="{{ route('friends.reject', $friend->id) }}">{{__('profile.reject')}}</a>
                            </object>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    @if($friendsPending->count())
        <p class="friends-requests-title">{{__('profile.outgoing')}}</p>
        <div class="Friends-List">
            <div class="UserItemList">

                @foreach($friendsPending as $friend)
                    <a href="{{ route('profile.main', $friend->id) }}" class="UserItem UserItemList-item">
                        <div class="UserAvatar">
                            @if ($friend->image)
                                <img src="{{ Storage::url($friend->image)}}" alt="Avatar">
                            @else
                                <img src="{{ Storage::url('avatar.png')}}" alt="Avatar">
                            @endif
                        </div>
                        <div class="UserItem-info">
                            <div class="UserItem-name">
                                {{ $friend->name }}
                            </div>
                            <div class="UserItem-experience">
                                {{__('profile.experience')}}: {{ $friend->experience->total_experience }}
                            </div>
                            <object>
                                <a class="accept-or-reject"
                                   href="{{ route('friends.cancel', $friend->id) }}">{{__('profile.cancel')}}</a>
                            </object>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
@endif


@endsection
