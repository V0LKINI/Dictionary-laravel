<?php

namespace App\Http\Controllers;

use App\Http\Requests\WordRequest;
use App\Models\Word;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class WordsController extends Controller
{
    public function add(WordRequest $request)
    {
        try {
            $word = Word::addWord(Auth::id(), $request->english, $request->russian);
            return response()->json(view('layouts.oneTableWord', compact('word'))->render());
        } catch (BadRequestException $e) {
            http_response_code(400);
            echo $e->getMessage();
        }
    }

    public function delete($word_id)
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

    public function edit(WordRequest $request)
    {
        try {
            $word = Word::editWord($request);
            return response()->json(view('layouts.oneTableWord', compact('word'))->render());
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
}
