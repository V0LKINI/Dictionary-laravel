<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    public function delete($user_id)
    {
        $user = User::where('id', $user_id)->first();

        if (!$user){
            session()->flash('warning', 'Пользователя не существует');
            return redirect()->route('profile.main', Auth::user()->id);
        }

        if (!Auth::user()->isFriendWithMe($user)){
            session()->flash('warning', 'Пользователь не в друзьях');
            return redirect()->route('profile.main', Auth::user()->id);
        }

        Auth::user()->deleteFriend($user);

        session()->flash('success', 'Пользователь удалён из друзей');
        return redirect()->route('profile.main', Auth::user()->id);
    }

    public function getAdd($user_id)
    {
        $user = User::where('id', $user_id)->first();

        if (!$user){
            session()->flash('warning', 'Пользователя не существует');
            return redirect()->route('profile.main', Auth::user()->id);
        }

        if (Auth::user()->hasFriendRequestPending($user)){
            session()->flash('warning', 'Пользователю уже отправлен запрос дружбы');
            return redirect()->route('profile.main', Auth::user()->id);
        }

        if ($user->hasFriendRequestPending(Auth::user())){
            session()->flash('warning', 'Пользователь отправил вам запрос дружбы. Примите его');
            return redirect()->route('profile.main', Auth::user()->id);
        }

        if ($user->isFriendWithMe(Auth::user())){
            session()->flash('warning', 'Пользователь уже у вас в друзьях');
            return redirect()->route('profile.main', Auth::user()->id);
        }

        if ($user->id === Auth::user()->id){
            session()->flash('warning', 'Вы не можете добавить в друзья самого себя =)');
            return redirect()->route('profile.main', Auth::user()->id);
        }

        Auth::user()->addFriend($user);

        session()->flash('success', 'Заявка в друзья отправлена');
        return redirect()->route('profile.main', $user->id);
    }

    public function getAccept($user_id)
    {
        $user = User::where('id', $user_id)->first();

        if (!$user){
            session()->flash('warning', 'Пользователя не существует');
            return redirect()->route('profile.main', Auth::user()->id);
        }

        if (!Auth::user()->hasFriendRequestReceived($user)){
            session()->flash('warning', 'Невозможно принять несуществующую заявку в друзья');
            return redirect()->route('profile.main', Auth::user()->id);
        }

        Auth::user()->acceptFriendRequest($user);

        session()->flash('success', 'Пользователь добавлен в друзья');
        return redirect()->route('profile.main', Auth::user()->id);
    }

    public function getReject($user_id)
    {
        $user = User::where('id', $user_id)->first();

        if (!$user){
            session()->flash('warning', 'Пользователя не существует');
            return redirect()->route('profile.main', Auth::user()->id);
        }

        if (!Auth::user()->hasFriendRequestReceived($user)){
            session()->flash('warning', 'Невозможно отклонить несуществующую заявку в друзья');
            return redirect()->route('profile.main', Auth::user()->id);
        }

        Auth::user()->rejectFriendRequest($user);

        session()->flash('success', 'Заявка в друзья отклонена');
        return redirect()->route('profile.main', Auth::user()->id);
    }

    public function getCancel($user_id)
    {
        $user = User::where('id', $user_id)->first();

        if (!$user){
            session()->flash('warning', 'Пользователя не существует');
            return redirect()->route('profile.main', Auth::user()->id);
        }

        if (!Auth::user()->hasFriendRequestPending($user)){
            session()->flash('warning', 'Невозможно отменить несуществующую заявку в друзья');
            return redirect()->route('profile.main', Auth::user()->id);
        }

        Auth::user()->cancelFriendRequest($user);

        session()->flash('success', 'Заявка в друзья отменена');
        return redirect()->route('profile.main', Auth::user()->id);
    }
}
