<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class WordsController extends Controller
{
    public function create(Request $request)
    {
        try {
            $word = Word::addWord(Auth::id(), $request->english, $request->russian);
            return view('layouts.oneTableWord', compact('word'));
        } catch (ValidationException $e) {
            http_response_code(400);
            echo $e->validator;
        } catch (BadRequestException $e) {
            http_response_code(400);
            echo $e->getMessage();
        }
    }

    public function destroy($word_id)
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

    public function edit(Request $request)
    {
        try {
            $word = Word::editWord($request);
            return view('layouts.oneTableWord', compact('word'));
        } catch (ValidationException $e) {
            http_response_code(400);
            echo $e->validator;
        } catch (AccessDeniedException $e) {
            http_response_code(403);
            echo $e->getMessage();
        } catch (BadRequestException $e) {
            http_response_code(400);
            echo $e->getMessage();
        }
    }

    public function resetProgress($word_id)
    {

    }
}
