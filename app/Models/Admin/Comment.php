<?php

namespace App\Models\Admin;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reply()
    {
        return $this->hasMany(Comment::class, 'p_id');
    }

    public function post()
    {
        return $this->belongsTo(News::class, 'p_id');
    }
}
