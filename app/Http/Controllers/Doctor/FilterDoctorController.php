<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\DoctorSlot;
use App\Models\Models\Appointment;
use Illuminate\Support\Facades\DB;

class FilterDoctorController extends Controller
{
    public function filterdoctor($category, $slot)
    {
        $category = DoctorCategory::where('name', $category)->first();

        return DB::table('doctors')
            ->join('doctor_doctor_slot', 'doctor_doctor_slot.doctor_id', '=', 'doctors.id')
            ->join('doctor_slots', 'doctor_slots.id', '=', 'doctor_doctor_slot.doctor_slot_id')
            ->join('doctor_categories', 'doctors.category_id', '=', 'doctor_categories.id')
            ->join('users', 'doctors.user_id', '=', 'users.id')
            ->select('doctors.id as docid', 'doctors.user_id', 'doctors.specialist', 'doctors.fees', 'doctors.gender', 'doctors.birthday', 'doctors.address', 'doctors.city', 'doctors.zipcode', 'doctors.degree', 'doctors.offday', 'doctor_categories.name as catname', 'doctor_categories.id as catid', 'doctor_slots.start_time', 'doctor_slots.end_time', 'doctor_slots.id as slotid', 'users.image', 'users.name')
            ->where('doctor_categories.id', $category->id)
            ->where('doctor_slots.id', $slot)
            ->get();
    }

    public function filterdoctorById($docid, $slot)
    {
        return $users = DB::table('doctors')
            ->join('doctor_doctor_slot', 'doctor_doctor_slot.doctor_id', '=', 'doctors.id')
            ->join('doctor_slots', 'doctor_slots.id', '=', 'doctor_doctor_slot.doctor_slot_id')
            ->join('doctor_categories', 'doctors.category_id', '=', 'doctor_categories.id')
            ->join('users', 'doctors.user_id', '=', 'users.id')
            ->select('doctors.id as docid', 'doctors.user_id', 'doctors.specialist', 'doctors.fees', 'doctors.gender', 'doctors.birthday', 'doctors.address', 'doctors.city', 'doctors.zipcode', 'doctors.degree', 'doctors.offday', 'doctor_categories.name as catname', 'doctor_categories.id as catid', 'doctor_slots.start_time', 'doctor_slots.end_time', 'doctor_slots.id as slotid', 'users.image', 'users.name')
            ->where('doctors.id', $docid)
            ->where('doctor_slots.id', $slot)
            ->get();
    }

    function checkappointment(Request $request)
    {
        //return $request->all();
        return Appointment::where('appdate', $request->date)->where('slot_id', $request->doctor_slot_id)->where('doctor_id', $request->doctor_id)->where('status', 1)->count();
    }
}
