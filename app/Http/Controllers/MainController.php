<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function main()
    {
        $user = Auth::user();
        return view('main', compact('user'));
    }

    public function admin()
    {
        $allUsers = User::get();
        $user = Auth::user();
        return view('admin/main', compact('allUsers', 'user'));
    }

    public function changeTheme(Request $request)
    {
        Auth::user()->changeTheme($request->isDark);
    }

}
