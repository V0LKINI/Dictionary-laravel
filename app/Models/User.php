<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Атрибуты, которым можно массово присваивать значения.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Атрибуты, которые должны быть скрыты для массивов.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Аттрибуты, которые запрещено заполнять.
     *
     * @var array
     */
    protected $guarded = [
        'is_admin',
    ];

    /**
     * Атрибуты, которые должны быть приведены к собственным типам.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Каждый пользователь имеет сколько угодно слов.
     */
    public function words()
    {
        return $this->hasMany(Word::class)->orderByDesc('updated_at');
    }

    /**
     * Каждый пользователь имеет строчку в таблице упражнений.
     */
    public function experience()
    {
        return $this->hasOne(Experience::class);
    }

    /**
     * Увеличить опыт пользователя в БД.
     *
     * param int $experience
     *
     * @return void
     */
    public function increaseExperience(int $experience): void
    {
        $this->experience->daily_experience += $experience;
        $this->experience->weekly_experience += $experience;
        $this->experience->monthly_experience += $experience;
        $this->experience->total_experience += $experience;
        $this->experience->save();
    }

    /**
     * Проверить, является ли пользователь администратором.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->is_admin === 1;
    }
}
