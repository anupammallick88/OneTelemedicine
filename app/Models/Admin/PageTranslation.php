<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'locale',
        'page_id',
        'label',
    ];
}
