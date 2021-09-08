<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function main()
    {
        $user = Auth::user();
        $words = Word::with('exercise')->where('user_id', '=', $user->id)
            ->orderByDesc('updated_at')->take(50)->get();
        return view('main', compact('user', 'words'));
    }

    public function load(Request $request)
    {
        $skip = $request->page * 50;
        $words = Word::where('user_id', '=', Auth::id())->orderByDesc('updated_at')->take(50)->skip($skip)->get();
        return view('layouts.load', compact('words'));
    }

    public function admin()
    {
        $allUsers = User::get();
        $user = Auth::user();
        return view('adminPanel', compact('allUsers', 'user'));
    }
}
