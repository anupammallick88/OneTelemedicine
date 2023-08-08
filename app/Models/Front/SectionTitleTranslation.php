<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionTitleTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'locale',
        'section_title_id',
        'title',
        'description',
    ];
}
