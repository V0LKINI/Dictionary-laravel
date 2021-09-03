<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = ['daily_experience', 'weekly_experience', 'monthly_experience', 'total_experience'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
