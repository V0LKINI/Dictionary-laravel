<?php

namespace App\Http\Controllers;

use App\Http\Requests\WordRequest;
use App\Models\Word;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DictionaryController extends Controller
{
    public function main()
    {
        $user = Auth::user();
        $words = $user->words()->with('exercise')->orderByDesc('updated_at')->take(50)->get();
        return view('dictionary/main', compact('user', 'words'));
    }

    public function addWord(WordRequest $request)
    {
        try {
            $word = Word::addWord(Auth::id(), $request->english, $request->russian);
            return response()->json(view('dictionary.addWord', compact('word'))->render());
        } catch (BadRequestException $e) {
            http_response_code(400);
            echo $e->getMessage();
        }
    }

    public function deleteWord($word_id)
    {
        try {
            Word::deleteWord(Auth::id(), $word_id);
        } catch (BadRequestException $e) {
            http_response_code(400);
            echo $e->getMessage();
        } catch (AccessDeniedException $e) {
            http_response_code(403);
            echo $e->getMessage();
        }
    }

    public function editWord(WordRequest $request)
    {
        try {
            Word::editWord($request->id, $request-> english, $request->russian);
            echo true;
        } catch (AccessDeniedException $e) {
            http_response_code(403);
            echo $e->getMessage();
        } catch (BadRequestException $e) {
            http_response_code(400);
            echo $e->getMessage();
        }
    }

    public function resetWordProgress($word_id)
    {
        try {
            Word::resetWord(Auth::id(), $word_id);
        } catch (AccessDeniedException $e) {
            http_response_code(403);
            echo $e->getMessage();
        } catch (BadRequestException $e) {
            http_response_code(400);
            echo $e->getMessage();
        }
    }

    public function loadWords(Request $request)
    {
        $skip = $request->page * 50;
        $words = Word::where('user_id', '=', Auth::id())->with('exercise')->orderByDesc('updated_at')->take(50)->skip($skip)->get();
        return view('dictionary.load', compact('words'));
    }

}
