<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['category', 'user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(DoctorCategory::class, 'category_id', 'id');
    }

    public function earning()
    {
        return $this->hasMany(Earning::class, 'doctor_id', 'id');
    }

    public function checkOffDay($day)
    {
        $array_off_day = explode(',', $this->offday);

        if (in_array($day,  $array_off_day)) {
            return true;
        }
    }

    public function slot()
    {
        return $this->belongsToMany(DoctorSlot::class, 'doctor_doctor_slot', 'doctor_id', 'doctor_slot_id')->orderBy('start_time');
    }
}
