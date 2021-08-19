<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function main(Request $request)
    {
        $user = Auth::user();
        if ($user){
            $words = Word::where('user_id',$user->id)->get();
            return view('main', compact('words', 'user'));
        } else{
            return redirect('/login');
        }

    }

    public function exercises()
    {
        return view('exercises');
    }
}
