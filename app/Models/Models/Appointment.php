<?php

namespace App\Models\Models;

use App\Models\BankDeposite;
use App\Models\Doctor;
use App\Models\DoctorSlot;
use App\Models\Meeting;
use App\Models\TestReport;
use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function prescription()
    {
        return $this->hasMany('App\Models\Prescription');
    }

    public function testprescription()
    {
        return $this->hasMany('App\Models\TestPrescription');
    }

    public function slot()
    {
        return $this->hasOne(DoctorSlot::class, 'id', 'slot_id');
    }

    public function meeting()
    {
        return $this->hasOne(Meeting::class, 'appointment_id');
    }
    
    public function bank_deposite()
    {
        return $this->hasOne(BankDeposite::class, 'appointment_id');
    }

    // public function test_reports()
    // {
    //     return $this->belongsToMany(TestReport::class, 'appointment_id', 'id');
    // }

    public function testreports()
    {
        return $this->hasOne('App\Models\TestReport');
    }
}
