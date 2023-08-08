<?php

namespace App\Http\Controllers\Front;

use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SearchAppointmentController extends Controller
{
    public function search(Request $request)
    {
//        return $users = DB::table('appointments')
//            ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
//            ->join('users', 'users.id', '=', 'doctors.user_id')
//            ->join('doctor_slots', 'doctor_slots.id', '=', 'appointments.slot_id')
//            ->select('appointments.id as id','users.name', 'users.image', 'appointments.appdate', 'doctor_slots.start_time', 'doctor_slots.end_time')
//            ->where('appointments.user_id', '=', auth()->user()->id)
//            ->where('users.name', 'LIKE', '%' . $request->msg . '%')
//            ->get();
        $search = Appointment::where('user_id', auth()->user()->id)->with('doctor', 'doctor.user')
            ->whereHas('doctor.user', function($query) use($request) {
                $query->where('name', 'LIKE', "%{$request->msg}%" );
            })
            ->get();
        return view('front.search.patient-date-search', compact('search'));
    }

    public function patientsearch(Request $request)
    {
        if(Auth::user()->role == 'stuff') {
            $doctor = Doctor::where('user_id', Auth::user()->doctor_id)->first();
            $doctor_id = $doctor->id;
        }else {
            $doctor_id = Auth::user()->doctor->id;
        }
//        return $users = DB::table('appointments')
//            ->join('users', 'users.id', '=', 'appointments.user_id')
//            ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
//            ->join('doctor_slots', 'doctor_slots.id', '=', 'appointments.slot_id')
//            ->select('appointments.id as id','users.name', 'users.image', 'appointments.*', 'doctor_slots.start_time', 'doctor_slots.end_time')
//            ->where('appointments.doctor_id', '=', $doctor_id)
//            ->where('name', 'LIKE', '%' . $request->msg . '%')
//            ->get();
        $todaysapp = Appointment::where('doctor_id', $doctor_id)
            ->with('patient', 'slot', 'doctor', 'meeting')
            ->whereHas('patient', function($query) use($request) {
                $query->where('name', 'LIKE', "%{$request->msg}%");
            })
            ->orderBy('id', 'desc')->get();
        return view('front.search.doctor-search', compact('todaysapp'));
    }

    public function searchdate(Request $request)
    {

//        $search = DB::table('appointments')
//            ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
//            ->join('users', 'users.id', '=', 'doctors.user_id')
//            ->join('doctor_slots', 'doctor_slots.id', '=', 'appointments.slot_id')
//            ->select('appointments.id as id','users.name', 'users.image', 'appointments.*', 'doctor_slots.start_time', 'doctor_slots.end_time')
//            ->where('appointments.user_id', '=', auth()->user()->id)
//            ->where(function ($query) use ($request) {
//                $query->whereday('appointments.appdate', $request->date)->orWhereMonth('appointments.appdate', $request->date)
//                    ->orwhereYear('appointments.appdate', $request->date);
//            })->get();
        $search = Appointment::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')
            ->where('appdate', 'LIKE', "%{$request->date}%")
            ->get();
        return view('front.search.patient-date-search', compact('search'));
    }

    public function doctorsearchdate(Request $request)
    {
        if(Auth::user()->role == 'stuff') {
            $doctor = Doctor::where('user_id', Auth::user()->doctor_id)->first();
            $doctor_id = $doctor->id;
        }else {
            $doctor_id = Auth::user()->doctor->id;
        }
//        return $users = DB::table('appointments')
//            ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
//            ->join('users', 'users.id', '=', 'appointments.user_id')
//            ->join('doctor_slots', 'doctor_slots.id', '=', 'appointments.slot_id')
//            ->select('appointments.id as id','users.name', 'users.image', 'appointments.*', 'doctor_slots.start_time', 'doctor_slots.end_time')
//            ->where('appointments.doctor_id', '=', $doctor_id)
//            ->whereDay('appdate', $request->date)
//            ->orWhereMonth('appdate', $request->date)
//            ->orwhereYear('appdate', $request->date)
//            ->get();
        $todaysapp = Appointment::where('doctor_id', $doctor_id)
            ->with('patient', 'slot', 'doctor', 'meeting')
            ->where('appdate', 'LIKE', "%{$request->date}%")
            ->orderBy('id', 'desc')->get();
        return view('front.search.doctor-search', compact('todaysapp'));
    }
}
