<?php

namespace App\Models\Front;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    public $translatedAttributes = [
        'title',
        'description',
        'details',
        'slug',
    ];
    protected $fillable = [
        'user_id',
        'image',
        'icon',
        'tags',
        'status',
    ];
}
