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
            'puzzle' => Exercise::getPuzzleWordsCount($user->id),
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
        $exerciseName = 'russian_english';

        if ($count == 0) {
            session()->flash('error', 'У вас нет слов для изучения');
            return redirect()->route('exercises');
        }

        session(['russian_english.words' => $wordsArray]);

        return view('exercises.exercise',
            compact('user', 'wordsArray', 'count', 'exerciseName'));
    }

    public function englishRussian()
    {
        if (session()->has('english_russian')) {
            session()->forget('english_russian');
        }
        $user = Auth::user();
        $wordsArray = Exercise::getEnglishRussianWords($user->id);
        $count = count($wordsArray);
        $exerciseName = 'english_russian';

        if ($count == 0) {
            session()->flash('error', 'У вас нет слов для изучения');
            return redirect()->route('exercises');
        }

        session(['english_russian.words' => $wordsArray]);

        return view('exercises.exercise', compact('user', 'wordsArray', 'count', 'exerciseName'));
    }

    public function puzzle()
    {
        $user = Auth::user();
        $words = Exercise::getPuzzleWords($user->id);
        $count = count($words);

        if ($count == 0) {
            session()->flash('error', 'У вас нет слов для изучения');
            return redirect()->route('exercises');
        }

        return view('exercises.puzzle', compact('user', 'words', 'count'));
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

        session(['repetition.words' => $words]);

        return view('exercises.repetition', compact('user', 'words', 'count'));
    }

    public function getResultsExercise(Request $request)
    {
        $userAswers = $request->word;
        $exerciseName = $request->exerciseName;
        $results = ['rightAnsersCount' => 0];
        $words = session()->get($exerciseName.'.words');
        $rightWordsId = [];
        $index = 1;

        foreach ($words as $word) {
            if ($word['correct_translation'] == $userAswers[$index]) {
                $rightWordsId[] = $word['id'];
                $results['words'][$word['word']] = [$word['correct_translation'], true];
                $results['rightAnsersCount']++;
            } else {
                $results['words'][$word['word']] = [$word['correct_translation'], false];
            }
            $index++;
        }

        session()->forget($exerciseName);

        $user = Auth::user();
        $user->increaseExperience($results['rightAnsersCount']);
        Exercise::whereIn('word_id', $rightWordsId)->update([$exerciseName => 100, 'repeated_at' => date("Y-m-d H:i:s")]);

        return view('exercises.exerciseResults', compact('user', 'results', 'exerciseName'));
    }

    public function getResultsRepetition(Request $request)
    {
        $userAswers = $request->word;
        $exerciseName = 'repetition';
        $toRepeatWordsId = [];
        $dontRepeatWordsId = [];
        $results = ['rightAnsersCount' => 0];

        foreach (session()->get('repetition.words') as $index => $word) {
            if ($userAswers[$index + 1] === 'Не помню') {
                $results['words'][$word->english] = [$word->russian, false];
                $toRepeatWordsId[] = $word->id;
            } else {
                $results['words'][$word->english] = [$word->russian, true];
                $dontRepeatWordsId[] = $word->id;
                $results['rightAnsersCount']++;
            }
        }

        $user = Auth::user();
        $user->increaseExperience($results['rightAnsersCount']);
        Exercise::whereIn('word_id', $toRepeatWordsId)->update([
            'russian_english' => 0,
            'english_russian' => 0,
            'puzzle' => 0,
            'repeated_at' => date("Y-m-d H:i:s"),
        ]);
        Exercise::whereIn('word_id', $dontRepeatWordsId)->update([
            'repeated_at' => date("Y-m-d H:i:s"),
        ]);

        return view('exercises.exerciseResults', compact('user', 'results', 'exerciseName'));
    }


    public function getResultsPuzzle(Request $request)
    {
        $count = count($request->words_id);
        $user = Auth::user();
        $user->increaseExperience($count);
        Exercise::whereIn('word_id', $request->words_id)->update(['puzzle' => 100, 'repeated_at' => date("Y-m-d H:i:s")]);
        return redirect('/exercises');
    }
}
