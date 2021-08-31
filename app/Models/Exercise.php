<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = ['word_id', 'english_russian', 'russian_english', 'repeated_at'];

    public $timestamps = false;

    public function word()
    {
        return $this->belongsTo(Word::class);
    }

    public function getProgress()
    {
        return ($this->russian_english + $this->english_russian) / 2;
    }

    public function resetProgress()
    {
        if ($this->getProgress() === 0) {
            exit;
        }

        if ($this->word->user->id !== Auth::id()) {
            throw new AccessDeniedException('Вы не можете редактировать чужие слова!');
        }

        $this->english_russian = 0;
        $this->russian_english = 0;
        $this->save();
    }

    public static function getRussianEnglishWordsCount($user_id)
    {
        $words = Word::where('user_id', $user_id)->whereHas('exercise', function($q){
            $q->where('russian_english','=','0');
        })->get();
        $count = $words->count();
        return $count;
    }

    public static function getEnglishRussianWordsCount($user_id)
    {
        $words = Word::where('user_id', $user_id)->whereHas('exercise', function($q){
            $q->where('english_russian','=','0');
        })->get();
        $count = $words->count();
        return $count;
    }

    public static function getRepetitionWordsCount($user_id)
    {
        $words = Word::where('user_id', $user_id)->whereHas('exercise', function($q){
            $q->where('english_russian','=', 100)->where('russian_english','=', 100);
        })->get();
        $count = $words->count();
        return $count;
    }

    public static function getRussianEnglishWords($user_id)
    {
        $words = Word::where('user_id', $user_id)->whereHas('exercise', function($q){
            $q->where('russian_english', 0);
        })->inRandomOrder()->take(10)->get();

        $count = $words->count();

        $extraWords = Word::where('user_id', 1)->whereHas('exercise', function($q){
            $q->where('russian_english', 100);
        })->inRandomOrder()->take($count*3)->get();

        $wordsArray = [];
        $i = 0;
        foreach ($words as $word){
            $wordsArray[$i] = [
                0 => $word->english,
                1 => $extraWords[$i * 3 + 0]->english,
                2 => $extraWords[$i * 3 + 1]->english,
                3 => $extraWords[$i * 3 + 2]->english
            ];
            shuffle($wordsArray[$i]);
            $wordsArray[$i]['correct_translation'] = $word->english;
            $wordsArray[$i]['word'] = $word->russian;
            $wordsArray[$i]['id'] = $word->id;
            $wordsArray[$i]['index'] = $i+1;
            $i++;
        }
        return $wordsArray;
    }

    public static function getEnglishRussianWords($user_id)
    {
        $words = Word::where('user_id', $user_id)->whereHas('exercise', function($q){
            $q->where('english_russian', 0);
        })->inRandomOrder()->take(10)->get();

        $count = $words->count();

        $extraWords = Word::where('user_id', 1)->whereHas('exercise', function($q){
            $q->where('english_russian', 100);
        })->inRandomOrder()->take($count*3)->get();

        $wordsArray = [];
        $i = 0;
        foreach ($words as $word){
            $wordsArray[$i] = [
                0 => $word->russian,
                1 => $extraWords[$i * 3 + 0]->russian,
                2 => $extraWords[$i * 3 + 1]->russian,
                3 => $extraWords[$i * 3 + 2]->russian
            ];
            shuffle($wordsArray[$i]);
            $wordsArray[$i]['correct_translation'] = $word->russian;
            $wordsArray[$i]['word'] = $word->english;
            $wordsArray[$i]['id'] = $word->id;
            $wordsArray[$i]['index'] = $i+1;
            $i++;
        }
        return $wordsArray;
    }

    public static function getRepetitionWords($user_id)
    {
        $words = Word::where('user_id', $user_id)->get();
    }

}
