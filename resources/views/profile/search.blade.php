@extends('layouts.master')

@section('title', 'Профиль')

@section('content')
    <h3>Результаты поиска: "{{ Request::input('query') }}"</h3>


    <div class="Friends-List">
        <div class="UserItemList">
            @if(!$users->count())
                <p>Ничего не найдено</p>
            @else
                @foreach($users as $foundUser)
                    <a href="{{ route('profile.main', $foundUser->id) }}" class="UserItem UserItemList-item">
                        <div class="UserAvatar">
                            @if ($foundUser->image)
                                <img src="{{ Storage::url($foundUser->image)}}" alt="Avatar">
                            @else
                                <img src="{{ Storage::url('avatar.png')}}" alt="Avatar">
                            @endif
                        </div>
                        <div class="UserItem-info">
                            <div class="UserItem-name">
                                {{ $foundUser->name }}
                            </div>
                            <div class="UserItem-experience">
                                <p>Опыт: {{ $foundUser->experience->total_experience }}</p>
                            </div>
                        </div>

                    </a>
                @endforeach
            @endif
        </div>
    </div>
@endsection