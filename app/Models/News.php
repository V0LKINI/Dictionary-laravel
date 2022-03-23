<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    /**
     * Атрибуты, которым можно массово присваивать значения.
     *
     * @var array
     */
    protected $fillable = ['title', 'code', 'description', 'image'];

}
