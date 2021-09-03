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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Аттрибуты, которые запрещено заполнять
     *
     * @var array
     */
    protected $guarded = [
        'is_admin'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function words()
    {
        return $this->hasMany(Word::class)->orderByDesc('updated_at');
    }

    public function experience()
    {
        return $this->hasOne(Experience::class);
    }

    public function incrementExperience()
    {
        $this->experience->daily_experience+=1;
        $this->experience->weekly_experience+=1;
        $this->experience->monthly_experience+=1;
        $this->experience->total_experience+=1;
        $this->experience->save();
    }

    public function isAdmin()
    {
        return $this->is_admin === 1;
    }
}
