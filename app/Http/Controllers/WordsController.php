<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class WordsController extends Controller
{
    public function add(Request $request)
    {
        try {
            $word = Word::addWord(Auth::id(), $request->english, $request->russian);
            return view('layouts.oneTableWord', compact('word'));
        } catch (ValidationException $e){
            http_response_code(400);
            echo $e->validator;
        }
    }

    public function delete($word_id)
    {
        $word = Word::where('id', $word_id)->first();
        if ($word === null) {
            return redirect()->route('main');
        }

        if ($word->user->id !== Auth::id()) {
            return redirect()->route('main');
        }
        $word->delete();
    }

    public function edit($word_id)
    {

    }

    public function resetProgress($word_id)
    {

    }
}
