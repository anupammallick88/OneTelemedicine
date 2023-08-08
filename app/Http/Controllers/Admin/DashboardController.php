<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use App\Models\Earning;
use App\Models\Models\Appointment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\JsVariables;

class DashboardController extends Controller
{
    use JsVariables;
    public function index()
    {
        $doctorCount =  User::where('role', 'doctor')->count();
        $patientCount =  User::where('role', 'patient')->count();
        $appointmentCount =  Appointment::all()->count();

        $earning = Earning::pluck('earning')->sum();
         $doctors = User::where('role', 'doctor')->orderBy('created_at', 'asc')->take(4)->get();
        $appointment = Appointment::orderBy('created_at', 'desc')->take(6)->get();
        //weekly earning
        $yearArray = [];

        $earningYear = Earning::orderBy('created_at', 'asc')->pluck('created_at')->map(function ($pet) {
            return $pet->format('Y');
        })->unique();

        foreach ($earningYear as $year) {
            array_push($yearArray,  $year);
        }

        $yearArraytoString = implode(",", $yearArray);

        $yearlyEarningAmountArray = [];

        $yearlyEarningAmount = DB::table('earnings')->orderBy('created_at', 'asc')->get(['id', 'earning', 'created_at'])->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('Y');
        })->map(function ($row) {
            return $row->sum('earning');
        });

        foreach ($yearlyEarningAmount as $amount) {
            array_push($yearlyEarningAmountArray,  $amount);
        }

        $earningArraytoString = implode(",", $yearlyEarningAmountArray);
        $adminDashboardVariables = $this->adminDashboardVariables($yearArraytoString, $earningArraytoString);
        return view('admin.dashboard.index', compact('yearArraytoString','earningArraytoString', 'appointment', 'doctors', 'doctorCount', 'patientCount', 'appointmentCount', 'earning', 'adminDashboardVariables'));
    }
}
