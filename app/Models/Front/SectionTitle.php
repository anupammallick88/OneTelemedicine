<?php

namespace App\Models\Front;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionTitle extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    public $translatedAttributes = [
        'title',
        'description',
    ];
    protected $fillable = [
        'name',
    ];
}
