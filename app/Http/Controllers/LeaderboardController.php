<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    public function main()
    {
        $user = Auth::user();
        return view('leaderboard', compact('user'));
    }
}
