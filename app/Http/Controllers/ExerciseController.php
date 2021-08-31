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
        if (session()->has('russian_english')){
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
        if (session()->has('english_russian')){
            session()->forget('english_russian');
        }
        $user = Auth::user();
        $wordsArray = Exercise::getEnglishRussianWords($user->id);
        $count = count($wordsArray);

        if ($count == 0){
            session()->flash('error', 'У вас нет слов для изучения');
            return redirect()->route('exercises')
;        }

        session(['english_russian.experience' => 0]);
        return view('exercises.english-russian', compact('user', 'wordsArray', 'count'));
    }

    public function repetition()
    {
        $user = Auth::user();
        return view('exercises.repetition', compact('user'));
    }

    public function checkAnswer(Request $request)
    {
        $exerciseName = $request->exerciseName;
        $word = Exercise::where('word_id', $request->word_id)->first();

        if ($request->result === 'true') {
            $word->$exerciseName = 100;
            $user = Auth::user();
            $user->experience++;
            $word->save();
            $user->save();

            session([$exerciseName . '.results.' . $word->word->russian => [$word->word->english, true]]);
            session()->increment($exerciseName . '.experience');
        } else {
            session([$exerciseName . '.results.' . $word->word->russian => [$word->word->english, false]]);
        }

    }

    public function getResults(Request $request){
        $exerciseName = $request->exerciseName;
        $results = session()->get($exerciseName . '.results');
        $experience = session()->get($exerciseName . '.experience');
        session()->forget($exerciseName);
        return view('exercises.exerciseResults', compact('results', 'experience'));
    }
}
