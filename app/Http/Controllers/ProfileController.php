<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\UploadTrait;

class ProfileController extends Controller
{
    use UploadTrait;

    public function main(int $id)
    {
        $user = Auth::user();
        if ($user->id !==$id){
            $userProfile = User::where('id', $id)->first();
        } else {
            $userProfile = $user;
        }
        $friends = $userProfile->friends()->load('experience');
        $friendRequests = $userProfile->friendRequests()->load('experience');
        return view('profile.main', compact('user','userProfile', 'friends', 'friendRequests'));
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

        if ($request->has('image')) {
            $image = $request->file('image');
            $name = $user->id;
            $folder = '/avatars/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $user->image = $filePath;
        }

        $user->save();
        session()->flash('success', 'Настройки профиля сохранены');

        return redirect()->route('profile.edit');
    }
}
