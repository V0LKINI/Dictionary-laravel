<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function main(int $id)
    {
        $user = Auth::user();

        if ($user->id !== $id) {
            $userProfile = User::where('id', $id)->first();
        } else {
            $userProfile = $user;
        }

        $friends = $userProfile->friends()->load('experience');
        $friendRequests = $userProfile->friendRequests()->load('experience');
        $friendsPending = $userProfile->friendRequestPending()->load('experience');

        return view('profile.main',
            compact('user', 'userProfile', 'friends', 'friendRequests', 'friendsPending'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.editProfile', compact('user'));
    }

    public function save(ProfileRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->has('image')){
            $image = $request->file('image');
            Storage::delete($user->image);
            $path = $image->storeAs(
                'avatars', $user->id.'.'.$image->getClientOriginalExtension()
            );
            $user->image = $path;
        }

        $user->save();
        session()->flash('success', __('profile.profile_save'));

        return redirect()->route('profile.edit');
    }

    public function getSearch(Request $request)
    {
        $user = Auth::user();

        $query = $request->input('query');
        if ( ! $query) {
            return redirect()->route('profile.main', $user->id);
        }

        $users = User::where('name', 'LIKE', "%{$query}%")->get();

        return view('profile.search', compact('user', 'users'));
    }
}
