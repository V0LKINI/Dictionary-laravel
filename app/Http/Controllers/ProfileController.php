<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\Traits\UploadTrait;

class ProfileController extends Controller
{
    use UploadTrait;

    public function main()
    {
        $user = Auth::user();
        return view('profile.main', compact('user'));
    }

    public function edit(ProfileRequest $request)
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

        return redirect()->route('profile.main');
    }
}
