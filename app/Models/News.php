<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory, Translatable;

    /**
     * Атрибуты, которым можно массово присваивать значения.
     *
     * @var array
     */
    protected $fillable = ['title', 'title_en', 'code', 'description', 'description_en', 'image'];

}
