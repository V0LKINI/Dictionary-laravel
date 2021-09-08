<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class LeaderboardController extends Controller
{
    public function main()
    {
        $user = Auth::user();
        $userRatingList = Experience::with('user')->orderByDesc('total_experience')
            ->take(100)->get();
        return view('leaderboard.leaderboard', compact('user', 'userRatingList'));
    }

    public function resetDaily()
    {
        DB::table('experiences')->update(['daily_experience' => 0]);
        session()->flash('success', 'Дневной опыт сброшен');
        return redirect()->route('admin');
    }

    public function resetWeekly()
    {
        DB::table('experiences')->update(['weekly_experience' => 0]);
        session()->flash('success', 'Недельный опыт сброшен');
        return redirect()->route('admin');
    }

    public function resetMonthly()
    {
        DB::table('experiences')->update(['monthly_experience' => 0]);
        session()->flash('success', 'Месячный опыт сброшен');
        return redirect()->route('admin');
    }
}
