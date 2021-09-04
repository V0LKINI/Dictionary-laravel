<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{
    public function main()
    {
        $user = Auth::user();
        $wordsCount = [
            'ruEng' => Exercise::getRussianEnglishWordsCount($user->id),
            'engRu' => Exercise::getEnglishRussianWordsCount($user->id),
            'repetition' => Exercise::getRepetitionWordsCount($user->id),
        ];
        return view('exercises.main', compact('user', 'wordsCount'));
    }

    public function russianEnglish(Request $request)
    {
        if (session()->has('russian_english')) {
            session()->forget('russian_english');
        }

        $user = Auth::user();
        $wordsArray = Exercise::getRussianEnglishWords($user->id);
        $count = count($wordsArray);

        if ($count == 0) {
            session()->flash('error', 'У вас нет слов для изучения');
            return redirect()->route('exercises');
        }

        session(['russian_english.experience' => 0]);
        return view('exercises.russian-english', compact('user', 'wordsArray', 'count'));
    }

    public function englishRussian()
    {
        if (session()->has('english_russian')) {
            session()->forget('english_russian');
        }
        $user = Auth::user();
        $wordsArray = Exercise::getEnglishRussianWords($user->id);
        $count = count($wordsArray);

        if ($count == 0) {
            session()->flash('error', 'У вас нет слов для изучения');
            return redirect()->route('exercises');
        }

        session(['english_russian.experience' => 0]);
        return view('exercises.english-russian', compact('user', 'wordsArray', 'count'));
    }

    public function repetition()
    {
        if (session()->has('repetition')) {
            session()->forget('repetition');
        }
        $user = Auth::user();
        $words = Exercise::getRepetitionWords($user->id);
        $count = count($words);

        if ($count == 0) {
            session()->flash('error', 'У вас нет слов для повторения');
            return redirect()->route('exercises');
        }

        session(['repetition.count' => $count]);
        return view('exercises.repetition', compact('user', 'words', 'count'));
    }

    public function checkAnswer(Request $request)
    {
        $exerciseName = $request->exerciseName;
        $word = Exercise::where('word_id', $request->word_id)->first();

        if ($request->result === 'true') {
            session([$exerciseName.'.results.'.$word->word->russian => [$word->word->english, true]]);
            session()->increment($exerciseName.'.experience');

            $word->$exerciseName = 100;
            $word->repeated_at = date("Y-m-d H:i:s");
            $word->save();
            $user = Auth::user();
            $user->incrementExperience();
        } else {
            session([$exerciseName.'.results.'.$word->word->russian => [$word->word->english, false]]);
        }
    }

    public function checkAnswerRepetition(Request $request)
    {
        $word = Exercise::where('word_id', $request->word_id)->first();

        if ($request->result === 'false') {
            $word->russian_english = 0;
            $word->english_russian = 0;
            $word->repeated_at = date("Y-m-d H:i:s");
            session(['repetition.results.'.$word->word->russian => [$word->word->english, false]]);
        } else {
            $user = Auth::user();
            $user->incrementExperience();
            $word->repeated_at = date("Y-m-d H:i:s");
            session(['repetition.results.'.$word->word->russian => [$word->word->english, true]]);
        }
        $word->save();
    }

    public function getResults(Request $request)
    {
        $exerciseName = $request->exerciseName;
        $results = session()->get($exerciseName.'.results');
        $count = $request->count;

        if (session()->has($exerciseName.'.results')) {
            $currentCount = count(session()->get($exerciseName.'.results'));
        } else {
            $currentCount = 0;
        }

        if ($count != $currentCount) {
            header('HTTP/1.1 500 Internal Server Booboo');
            exit();
        }

        if ($exerciseName != 'repetition') {
            $experience = session()->get($exerciseName.'.experience');
        }

        if ($exerciseName == 'repetition') {
            $repeated = 0;
            foreach ($results as $result) {
                if ($result[1] === true) {
                    $repeated++;
                }
            }
        }

        if ($exerciseName == 'russian_english' or $exerciseName == 'english_russian') {
            return view('exercises.exerciseResults', compact('results', 'experience'));
        } elseif ($exerciseName == 'repetition') {
            return view('exercises.repetitionResults', compact('results', 'repeated'));
        }
    }
}
