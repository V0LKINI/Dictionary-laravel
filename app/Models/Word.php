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
        $word = self::where([['user_id', $user_id], ['english', $english]])->first();
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

    public static function deleteWord($user_id, $word_id)
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

    public static function editWord(Request $request)
    {
        $word = self::where('id', $request->id)->first();
        if ($word === null) {
            throw new BadRequestException('Слово не существует');
        }

        if ($word->user->id !== Auth::id()) {
            throw new AccessDeniedException('Вы не можете редактировать чужие слова!');
        }

        $word->russian = $request->russian;
        $word->english = $request->english;
        $word->save();
        return $word;
    }

    public static function resetWord($user_id, $word_id)
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
