<?php

namespace App\Models\Front;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    public $translatedAttributes = [
        'counter_one_count',
        'counter_one_title',
        'counter_two_count',
        'counter_two_title',
        'counter_three_count',
        'counter_three_title',
        'counter_four_count',
        'counter_four_title',
    ];
    protected $fillable = [
        'background_image',
        'image',
        'video',
        'counter_one_icon',
        'counter_two_icon',
        'counter_three_icon',
        'counter_four_icon',
    ];
}
