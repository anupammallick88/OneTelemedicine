<?php

namespace App\Models\Admin;

use App\User;
use App\Models\Admin\Category;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = [
        'title',
        'description',
        'slug',
        'details',
    ];
    protected $fillable = [
        'user_id',
        'category_id',
        'status',
        'image',
        'image_alt',
        'tags',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
