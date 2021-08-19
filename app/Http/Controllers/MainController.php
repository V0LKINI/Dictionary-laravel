<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;

class MainController extends Controller
{
    public function main(Request $request)
    {
        $words = Word::get();
        return view('main', compact('words'));
    }

    public function exercises()
    {
        return view('exercises');
    }
}
