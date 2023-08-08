<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['locale', 'slider_id', 'small_heading', 'big_heading', 'description'];
}
