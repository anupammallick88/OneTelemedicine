<?php

namespace App\Models\Admin;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    public $translatedAttributes = [
        'label',
    ];
    protected $fillable = [
        'title',
        'description',
        'url',
        'tags',
    ];
}
