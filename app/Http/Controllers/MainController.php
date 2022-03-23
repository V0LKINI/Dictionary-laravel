<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function main()
    {
        $user = Auth::user();
        $news = News::orderByDesc('id')->take(5)->get();
        return view('main', compact('user', 'news'));
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

    public function test()
    {
        $user = Auth::user();
        return view('test', compact('user'));
    }
}
