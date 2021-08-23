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

    public static function addWord($user_id, $english, $russian)
    {
        if ($english === null) {
            throw new ValidationException('Не передано слово');
        }

        if ($russian === null) {
            throw new ValidationException('Не передан перевод слова');
        }

        $word = self::where([['user_id', $user_id], ['english', $english]])->first();
        if ($word === null) {
            $word = self::create([
                'user_id' => $user_id,
                'english' => $english,
                'russian' => $russian
            ]);
            return $word;
        } else {
            throw new BadRequestException('Слово уже существует');
        }
    }

    public static function editWord(Request $request)
    {
        $word = Word::where('id', $request->id)->first();
        if ($word === null) {
            throw new BadRequestException('Слово не существует');
        }

        if ($word->user->id !== Auth::id()) {
            throw new AccessDeniedException('Вы не можете редактировать чужие слова!');
        }

        if ($request->english === null) {
            throw new ValidationException('Не передано слово');
        }

        if ($request->russian === null) {
            throw new ValidationException('Не передан перевод слова');
        }
        $word->russian = $request->russian;
        $word->english = $request->english;
        $word->save();
        return $word;
    }
}
