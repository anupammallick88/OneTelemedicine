<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    public $translatedAttributes = ['small_heading', 'big_heading', 'description'];
    protected $fillable = ['user_id', 'image', 'icon', 'status'];
}
