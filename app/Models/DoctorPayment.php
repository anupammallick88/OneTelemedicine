<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorPayment extends Model
{
    use HasFactory;

    protected $fillable = [
      'doctor_id',
      'amount',
        'note',
    ];
}
