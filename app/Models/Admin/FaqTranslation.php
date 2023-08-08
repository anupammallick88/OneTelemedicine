<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'locale',
        'faq_id',
        'question',
        'answer',
    ];
}
