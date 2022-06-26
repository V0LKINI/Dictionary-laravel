<?php

namespace App\Http\Controllers;

use App\Models\Grammar;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\News;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class MainController extends Controller
{
    public function main()
    {
        $news = Cache::rememberForever('news_main', function () {
            return News::orderByDesc('id')->take(5)->get();
        });

        return view('main', compact('news'));
    }

    public function admin()
    {
        $user = Auth::user();
        $allUsers = User::get();
        $allNews = News::orderByDesc('id')->get();
        $allRules = Grammar::get()->groupBy(function($data){ return $data->level; });
        return view('admin/main', compact('allUsers', 'user', 'allNews', 'allRules'));
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

    public function changeLocale($locale)
    {
        Cookie::queue("locale", $locale, time() + 3600*24*365);
        App::setLocale($locale);
        return redirect()->back();
    }

}
