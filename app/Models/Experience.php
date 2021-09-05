<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    /**
     * Атрибуты, которым можно массово присваивать значения.
     *
     * @var array
     */
    protected $fillable = ['daily_experience', 'weekly_experience', 'monthly_experience', 'total_experience'];

    /**
     * Убираем поля created_at и updated_at из БД, так как они нам не нужны.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Каждая строчка в таблице упражнений имеет только одного пользователя.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
