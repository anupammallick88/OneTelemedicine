<?php

namespace App\Http\Controllers\Stuff;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddStuffRequest;
use App\Http\Requests\StuffCreateAppointment;
use App\Models\DoctorSlot;
use App\Models\Earning;
use App\Models\Models\Appointment;
use App\Traits\JsVariables;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mews\Purifier\Facades\Purifier;

class HomeController extends Controller
{
    use JsVariables;

    public function addStuff(AddStuffRequest $request)
    {
        if ($request->password != $request->confirm_password) {
            return redirect()->back()->with('error', __('Password and confirm password not matched'));
        }
        $create = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'name' => $request->fname . ' ' . $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'stuff',
            'status' => '1',
            'approve' => '1',
            'doctor_id' => Auth::id(),
        ]);

        if (!is_null($create)) {
            return redirect()->back()->with('success', 'Staff is successfully added');
        }
        return redirect()->back()->with('error', 'Staff is not successfully added');
    }

    public function doctorindex(Request $request)
    {
        $doctor = User::whereId(Auth::user()->doctor_id)->with('doctor')->first();
        $data['doctor'] = User::whereId(Auth::user()->doctor_id)->with('doctor')->first();
        $data['newAppointment'] = Appointment::where('doctor_id', $doctor->doctor->id)->whereDate('created_at', '>=', Carbon::today()->subDays(7))->orderBy('id', 'desc')->count();

        $data['pendingAppointment'] = Appointment::where('doctor_id', $doctor->doctor->id)->whereDate('created_at', '<', Carbon::today())->orderBy('id', 'desc')->count();

        $data['todayrequest'] = Appointment::where('doctor_id', $doctor->doctor->id)->where('status', 0)->with('patient')->orderBy('id', 'desc')->get();

        $data['totalpatient'] = $collection =  Appointment::where('doctor_id', $doctor->doctor->id)->select('user_id')->distinct()->get()->count();
        $data['totalpatientmonth'] = Appointment::where('doctor_id', $doctor->doctor->id)->select('user_id')->whereMonth('appdate', now()->month)->distinct()->get()->count();

        $data['patient']  = User::where('role', 'patient')->orderBy('id', 'desc')->get();
        $data['totalearningmonth'] = Appointment::where('doctor_id', $doctor->doctor->id)->where('paymentmethod', '!=', 'cod')->whereMonth('appdate', now()->month)->sum('fees');
        $data['total_online_earning_month'] = Appointment::where('doctor_id', $doctor->doctor->id)->where('paymentmethod', '!=', 'cod')->whereMonth('appdate', now()->month)->sum('fees');
        // $data['total_offline_earning_month'] = Appointment::where('doctor_id', $doctor->doctor->id)->where('paymentmethod', 'cod')->whereMonth('appdate', now()->month)->sum('fees');

        $data['appointment'] = Appointment::all();

        $data['todaysapp'] = Appointment::where('doctor_id', $doctor->doctor->id)->where('appdate', Carbon::now()->format('Y-m-d'))->where('status', '!=', 0)->with('patient', 'slot', 'doctor')->orderBy('id', 'desc')->simplePaginate(5);

        $data['pastapp'] = Appointment::where('doctor_id', $doctor->doctor->id)->orderBy('status', 'asc')->simplePaginate(5);

        $data['pastappModal'] = Appointment::where('doctor_id', $doctor->doctor->id)->where('status', 2)->orWhere('appdate', '<', Carbon::now()->format('Y-m-d'))->orderBy('status', 'asc')->with('prescription')->get();

        $data['doctorVariables'] = $this->doctorVariables();
        $data['docslots'] = DoctorSlot::all();
        $data['stuffs'] = User::where('role', 'stuff')->where('doctor_id', Auth::id())->get();
        if (!is_null($request->get('tab'))) {
            $data['tab'] = $request->get('tab');
        } else {
            $data['tab'] = 'dashboard';
        }

        return view('front.pages.doctordashboard', $data);
    }

    public function createAppointment(StuffCreateAppointment $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!is_null($user)) {
            $user_id = $user->id;
        } else {
            $create_user = User::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'name' => $request->fname . ' ' . $request->lname,
                'email' => $request->email,
                'password' => Hash::make('123456789'),
                'role' => 'patient'
            ]);
            if (!is_null($create_user)) {
                $user_id = $create_user->id;
            }
        }
        $create_appointment = Appointment::create([
            'user_id' => $user_id,
            'doctor_id' => $request->doctor_id,
            'fees' => round($request->fees),
            'appdate' => $request->app_date,
            'apptime' => $request->slot_id,
            'doctorsService' => $request->doctorsService,
            'comment' => $request->comment,
            'paymentmethod' => 'cod',
            'status' => 0,
            'slot_id' => $request->slot_id,
        ]);
        Earning::create([
            'doctor_id' => $request->doctor_id,
            'user_id' => $user_id,
            'earning' => round($request->fees),
        ]);
        if (!is_null($create_appointment)) {
            return redirect()->back()->with('success', __('Appointment successfully done'));
        }
        return redirect()->back()->with('error', __('Something went wrong!'));
    }

    public function stuffDelete($id)
    {
        User::whereId($id)->delete();
        return redirect()->back()->with('success', __('Staff successfully removed!'));
    }
}
