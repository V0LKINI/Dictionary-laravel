<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Support\Facades\Auth;


class LeaderboardController extends Controller
{
    public function main()
    {
        $user = Auth::user();
        $userRatingList = Experience::orderByDesc('total_experience')->get()->take(100);
        return view('leaderboard.leaderboard', compact('user', 'userRatingList'));
    }
}
