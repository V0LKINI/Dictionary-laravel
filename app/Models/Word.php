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

    protected $fillable = ['user_id', 'english', 'russian'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exercise()
    {
        return $this->hasOne(Exercise::class);
    }

    public static function addWord($user_id, $english, $russian)
    {
        self::checkValidation($english, $russian);

        $word = self::where([['user_id', $user_id], ['english', $english]])->first();
        if ($word === null) {
            $word = self::create([
                'user_id' => $user_id,
                'english' => $english,
                'russian' => $russian
            ]);

            $exercise = new Exercise;
            $exercise->word_id = $word->id;
            $word->exercise()->save($exercise);

            return $word;
        } else {
            throw new BadRequestException('Слово уже существует');
        }
    }

    public static function editWord(Request $request)
    {
        $word = self::where('id', $request->id)->first();
        if ($word === null) {
            throw new BadRequestException('Слово не существует');
        }

        if ($word->user->id !== Auth::id()) {
            throw new AccessDeniedException('Вы не можете редактировать чужие слова!');
        }

        self::checkValidation($request->english, $request->russian);

        $word->russian = $request->russian;
        $word->english = $request->english;
        $word->save();
        return $word;
    }

    public static function checkValidation($english, $russian)
    {
        if ($english === null) {
            throw new ValidationException('Не передано слово');
        }

        if ($russian === null) {
            throw new ValidationException('Не передан перевод слова');
        }

        if (mb_strlen($english) >= 25) {
            throw new ValidationException('Слово слишком длинное');
        }

        if (mb_strlen($russian) >= 25) {
            throw new ValidationException('Перевод слишком длинный');
        }

        if (!preg_match('/^[a-zA-Z,.\-\s]+$/u', $english)) {
            throw new ValidationException('Слово должно состоять из букв латиницы');
        }

        if (!preg_match('/^[а-яА-ЯёЁ,.\-\s]+$/u', $russian)) {
            throw new ValidationException('Перевод должен состоять из букв кириллицы');
        }
    }

}
