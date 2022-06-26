<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class Word extends Model
{
    use HasFactory;

    /**
     * Атрибуты, которым можно массово присваивать значения.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'english', 'russian'];

    /**
     * Каждое слово принадлежит какому-то одному пользователю.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Каждое слово имеет строку в таблице exercises.
     */
    public function exercise()
    {
        return $this->hasOne(Exercise::class);
    }

    /**
     * Получить слово на русском.
     *
     * @param   string  $value
     *
     * @return string
     */
    public function getRussianAttribute(string $value): string
    {
        $first_char = mb_substr($value, 0, 1, 'UTF-8');
        $first_upper = mb_convert_case($first_char, MB_CASE_UPPER, 'UTF-8');
        $all_characters = mb_substr($value, 1, mb_strlen($value), 'UTF-8');
        return $first_upper.$all_characters;
    }

    /**
     * Получить слово на английском.
     *
     * @param   string  $value
     *
     * @return string
     */
    public function getEnglishAttribute(string $value): string
    {
        return ucfirst($value);
    }

    /**
     * Присвоить слово на русском.
     *
     * @param   string  $value
     *
     * @return void
     */
    public function setRussianAttribute(string $value): void
    {
        $this->attributes['russian'] = mb_strtolower($value);
    }

    /**
     * Присвоить слово на английском.
     *
     * @param   string  $value
     *
     * @return void
     */
    public function setEnglishAttribute(string $value): void
    {
        $this->attributes['english'] = strtolower($value);
    }

    /**
     * Добавить слово в БД.
     *
     * @param   int     $user_id
     * @param   string  $english
     * @param   string  $russian
     *
     * @return Exercise
     */
    public static function addWord(int $user_id, string $english, string $russian): Word
    {
        $word = self::where(['user_id' => $user_id, 'english' => $english])->first();
        if ($word === null) {
            $word = self::create([
                'user_id' => $user_id,
                'english' => $english,
                'russian' => $russian,
            ]);
            $exercise = new Exercise;
            $exercise->word_id = $word->id;
            $word->exercise()->save($exercise);
            return $word;
        } else {
            throw new BadRequestException('Слово уже существует');
        }
    }

    /**
     * Удалить слово из БД.
     *
     * @param   int  $user_id
     * @param   int  $word_id
     *
     * @return void
     */
    public static function deleteWord(int $user_id, int $word_id): void
    {
        $word = Word::where('id', $word_id)->first();
        if ($word === null) {
            throw new BadRequestException('Слово не существует');
        }

        if ($word->user->id !== $user_id) {
            throw new AccessDeniedException('Вы не можете удалять чужие слова!');
        }
        $word->delete();
    }

    /**
     * Отредактировать слово.
     *
     * @param   int     $word_id
     * @param   string  $english
     * @param   string  $russian
     *
     * @return Word
     */
    public static function editWord(int $word_id, string $english, string $russian): Word
    {
        $word = self::where('id', $word_id)->first();
        if ($word === null) {
            throw new BadRequestException('Слово не существует');
        }

        if ($word->user->id !== Auth::id()) {
            throw new AccessDeniedException('Вы не можете редактировать чужие слова!');
        }

        $word->russian = $russian;
        $word->english = $english;
        $word->save();
        return $word;
    }

    /**
     * Сбросить прогресс изучения слова.
     *
     * @param   int  $user_id
     * @param   int  $word_id
     *
     * @return void
     */
    public static function resetWord(int $user_id, int $word_id): void
    {
        $exercise = Exercise::where('word_id', $word_id)->first();
        if ($exercise === null) {
            throw new BadRequestException('Слово не найдено');
        }

        if ($exercise->word->user->id !== $user_id) {
            throw new AccessDeniedException('Вы не можете сбросить прогресс у чужого слова!');
        }
        $exercise->resetProgress();
    }

}
