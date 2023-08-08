<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'locale',
        'counter_id',
        'counter_one_count',
        'counter_one_title',
        'counter_two_count',
        'counter_two_title',
        'counter_three_count',
        'counter_three_title',
        'counter_four_count',
        'counter_four_title',
    ];
}
