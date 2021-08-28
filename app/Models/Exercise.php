<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

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

    public static function resetProgress($word_id)
    {
        $exercise = Exercise::where('word_id', $word_id)->first();
        if ($exercise->getProgress() === 0) {
            exit;
        }

        if ($exercise === null) {
            throw new BadRequestException('Слово не существует');
        }

        if ($exercise->word->user->id !== Auth::id()) {
            throw new AccessDeniedException('Вы не можете редактировать чужие слова!');
        }


        $exercise->english_russian = 0;
        $exercise->russian_english = 0;
        $exercise->save();
    }
}
