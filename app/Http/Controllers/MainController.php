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
        $allNews = News::orderByDesc('id')->get();
        return view('admin/main', compact('allUsers', 'user', 'allNews'));
    }

    public function blockUser(Request $request, $id)
    {
        $user = User::find($id);
        $date = date('Y-m-d H:i:s');
        $ban_date = date('Y-m-d H:i:s', strtotime($date.' + '.$request->ban_time.' days'));
        $user->banned_until = $ban_date;
        $user->save();

        return redirect()->route('admin');
    }

    public function unblockUser($id)
    {
        $user = User::find($id);
        $user->banned_until = null;
        $user->save();

        return redirect()->route('admin');
    }

    public function changeTheme(Request $request)
    {
        Auth::user()->changeTheme($request->isDark);
    }

}
