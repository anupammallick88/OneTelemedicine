<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'locale',
        'about_id',
        'title',
        'description',
        'icon_one_title',
        'icon_one_description',
        'icon_two_title',
        'icon_two_description',
        'icon_three_title',
        'icon_three_description',
    ];
}
