<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class Exercise extends Model
{
    use HasFactory;

    /**
     * Атрибуты, которым можно массово присваивать значения.
     *
     * @var array
     */
    protected $fillable = ['word_id', 'english_russian', 'russian_english', 'puzzle', 'repeated_at'];

    /**
     * Поля created_at и updated_at из БД.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Каждая строчка в таблице упражнений принадлежит какому-то одному слову.
     */
    public function word()
    {
        return $this->belongsTo(Word::class);
    }

    /**
     * Получить прогресс слова.
     *
     * @return int
     */
    public function getProgress(): int
    {
        return ($this->russian_english + $this->english_russian + $this->puzzle) / 3;
    }

    /**
     * Сбросить прогресс слова.
     *
     * @return void
     */
    public function resetProgress(): void
    {
        if ($this->getProgress() === 0) {
            exit;
        }

        if ($this->word->user->id !== Auth::id()) {
            throw new AccessDeniedException('Вы не можете редактировать чужие слова!');
        }

        $this->english_russian = 0;
        $this->russian_english = 0;
        $this->puzzle = 0;
        $this->save();
    }

    /**
     * Получить количество слов для изучения в упражнении Russian-English.
     *
     * param int $user_id
     *
     * @return int
     */
    public static function getRussianEnglishWordsCount(int $user_id): int
    {
        $count = Word::where('user_id', $user_id)->join('exercises', 'exercises.word_id', '=', 'words.id')
            ->where('russian_english', '=', '0')->count();
        return $count;
    }

    /**
     * Получить количество слов для изучения в упражнении English-Russian.
     *
     * param int $user_id
     *
     * @return int
     */
    public static function getEnglishRussianWordsCount(int $user_id): int
    {
        $count = Word::where('user_id', $user_id)->join('exercises', 'exercises.word_id', '=', 'words.id')
            ->where('english_russian', '=', '0')->count();
        return $count;
    }

    /**
     * Получить количество слов для изучения в упражнении puzzle.
     *
     * param int $user_id
     *
     * @return int
     */
    public static function getPuzzleWordsCount(int $user_id): int
    {
        $count = Word::where('user_id', $user_id)->join('exercises', 'exercises.word_id', '=', 'words.id')
            ->where('puzzle', '=', '0')->count();
        return $count;
    }

    /**
     * Получить количество слов для повторения.
     *
     * param int $user_id
     *
     * @return int
     */
    public static function getRepetitionWordsCount(int $user_id): int
    {
        $count = Word::where('user_id', $user_id)
            ->join('exercises', 'exercises.word_id', '=', 'words.id')
            ->where('english_russian', '=', 100)
            ->where('russian_english', '=', 100)
            ->where('puzzle', '=', 100)
            ->whereDate('exercises.created_at', '<', date('Y-m-d'))
            ->whereDate('exercises.repeated_at', '<', date('Y-m-d'))
            ->count();
        return $count;
    }

    /**
     * Получить массив слов для изучения в упражнении Russian-English.
     *
     * param int $user_id
     *
     * @return array
     */
    public static function getRussianEnglishWords(int $user_id): array
    {
        $words = Word::where('user_id', $user_id)->join('exercises', 'exercises.word_id', '=', 'words.id')
            ->where('russian_english', 0)->inRandomOrder()->take(10)->get();

        $count = $words->count();

        $extraWords = Word::where('user_id', 1)->join('exercises', 'exercises.word_id', '=', 'words.id')
            ->where('russian_english', 100)->inRandomOrder()->take($count * 3)->get();

        $wordsArray = [];
        $i = 0;
        foreach ($words as $word) {
            $wordsArray[$i] = [
                0 => $word->english,
                1 => $extraWords[$i * 3 + 0]->english,
                2 => $extraWords[$i * 3 + 1]->english,
                3 => $extraWords[$i * 3 + 2]->english,
            ];
            shuffle($wordsArray[$i]);
            $wordsArray[$i]['correct_translation'] = $word->english;
            $wordsArray[$i]['word'] = $word->russian;
            $wordsArray[$i]['id'] = $word->id;
            $i++;
        }
        return $wordsArray;
    }

    /**
     * Получить массив слов для изучения в упражнении English-Russian.
     *
     * param int $user_id
     *
     * @return array
     */
    public static function getEnglishRussianWords(int $user_id): array
    {
        $words = Word::where('user_id', $user_id)->join('exercises', 'exercises.word_id', '=', 'words.id')
            ->where('english_russian', 0)->inRandomOrder()->take(10)->get();

        $count = $words->count();

        $extraWords = Word::where('user_id', 1)->join('exercises', 'exercises.word_id', '=', 'words.id')
            ->where('english_russian', 100)->inRandomOrder()->take($count * 3)->get();

        $wordsArray = [];
        $i = 0;
        foreach ($words as $word) {
            $wordsArray[$i] = [
                0 => $word->russian,
                1 => $extraWords[$i * 3 + 0]->russian,
                2 => $extraWords[$i * 3 + 1]->russian,
                3 => $extraWords[$i * 3 + 2]->russian,
            ];
            shuffle($wordsArray[$i]);
            $wordsArray[$i]['correct_translation'] = $word->russian;
            $wordsArray[$i]['word'] = $word->english;
            $wordsArray[$i]['id'] = $word->id;
            $i++;
        }
        return $wordsArray;
    }


    public static function getPuzzleWords(int $user_id): array
    {
        $words = Word::where('user_id', $user_id)->join('exercises', 'exercises.word_id', '=', 'words.id')
            ->where('puzzle', 0)->inRandomOrder()->take(10)->get();

        $wordsArray = [];
        $i = 0;
        foreach ($words as $word) {
            $wordsArray[$i]['id'] = $word->id;
            $wordsArray[$i]['word'] = $word->russian;
            $wordsArray[$i]['translate'] = $word->english;
            $wordsArray[$i]['length'] = strlen($word->english);

            $properLettersArr = str_split(strtolower ($word->english));
            $extraLettersArr = [];
            for ($j=0; $j<(20-strlen($word->english)); $j++){
                $extraLettersArr[$j] = substr('abcdefghijklmnopqrstuvwxyz,-.', rand(0,28), 1);
            }
            $wordsArray[$i]['letters'] =array_merge($properLettersArr, $extraLettersArr);
            shuffle($wordsArray[$i]['letters']);

            $i++;
        }
        return $wordsArray;
    }

    /**
     * Получить коллекцию слов для повторения.
     *
     * param int $user_id
     *
     * @return Collection
     */
    public static function getRepetitionWords(int $user_id): Collection
    {
        $words = Word::where('user_id', $user_id)
            ->join('exercises', 'exercises.word_id', '=', 'words.id')
            ->where('english_russian', '=', 100)
            ->where('russian_english', '=', 100)
            ->where('puzzle', '=', 100)
            ->whereDate('exercises.created_at', '<', date('Y-m-d'))
            ->whereDate('exercises.repeated_at', '<', date('Y-m-d'))
            ->inRandomOrder()->take(10)->get();
        return $words;
    }

}
