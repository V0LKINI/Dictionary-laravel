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

    public function adminPanel()
    {
        $allUsers = User::get();
        $user = Auth::user();
        return view('adminPanel', compact('allUsers', 'user'));
    }
}
