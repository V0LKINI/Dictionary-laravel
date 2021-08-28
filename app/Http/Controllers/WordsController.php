<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class WordsController extends Controller
{
    public function add(Request $request)
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

    public function delete($word_id)
    {
        try {
            $word = Word::where('id', $word_id)->first();
            if ($word === null) {
                throw new BadRequestException('Слово не существует');
            }

            if ($word->user->id !== Auth::id()) {
                throw new AccessDeniedException('Вы не можете удалять чужие слова!');
            }
            $word->delete();
        } catch (BadRequestException $e) {
            http_response_code(400);
            echo $e->getMessage();
        } catch (AccessDeniedException $e) {
            http_response_code(403);
            echo $e->getMessage();
        }
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
        try {
            Exercise::resetProgress($word_id);
        } catch (AccessDeniedException $e) {
            http_response_code(403);
            echo $e->getMessage();
        } catch (BadRequestException $e) {
            http_response_code(400);
            echo $e->getMessage();
        }

    }
}
