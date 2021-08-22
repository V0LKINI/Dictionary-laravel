<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

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
        if ($english === null){
            throw new ValidationException( 'Не передано слово');
        }

        if ($russian === null){
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
        } else{
            throw ValidationException::withMessages('Такое слово уже добавлено');
        }
    }

}
