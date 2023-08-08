<?php

namespace App\Models\Front;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    public $translatedAttributes = [
        'title',
        'description',
        'icon_one_title',
        'icon_one_description',
        'icon_two_title',
        'icon_two_description',
        'icon_three_title',
        'icon_three_description',
    ];
    protected $fillable = [
        'image',
        'icon_one',
        'icon_two',
        'icon_three',
    ];
}
