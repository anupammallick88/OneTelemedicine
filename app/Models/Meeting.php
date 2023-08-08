<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    protected $fillable = [
        'topic',
        'meeting_id',
        'join_url',
        'password',
        'appointment_id',
        'doctor_id',
        'user_id',
    ];
}
