<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{
    public function main()
    {
        $user = Auth::user();
        return view('exercises', compact('user'));
    }
}
