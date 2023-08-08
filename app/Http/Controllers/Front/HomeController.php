<?php

namespace App\Http\Controllers\Front;

use App\Models\Meeting;
use App\Traits\ZoomMeetingTrait;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\TestReport;
use App\Models\DoctorSlot;
use App\Traits\JsVariables;
use Illuminate\Http\Request;
use App\Models\DoctorCategory;
use App\Models\PaymentPlatform;
use App\Models\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    use JsVariables, ZoomMeetingTrait;
    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    public function index(Request $request)
    {
        $doctor  = Doctor::all();
        $appointment = Appointment::all();
        $todaysapp = Appointment::where('user_id', auth()->user()->id)->where('appdate', Carbon::now()->format('Y-m-d'))->orderBy('status', 'desc')->simplePaginate(20);
        $pastapp = Appointment::where('user_id', auth()->user()->id)->where('appdate', '<', Carbon::now()->format('Y-m-d'))->orderBy('status', 'desc')->simplePaginate(20);
        $pastappall = Appointment::where('user_id', auth()->user()->id)->orderBy('status', 'desc')->simplePaginate(20);
        $pastappmodal = Appointment::where('user_id', auth()->user()->id)->orderBy('status', 'desc')->with('prescription', 'doctor', 'slot', 'meeting')->get();
        $paymentPlatforms = PaymentPlatform::all();
        $doctorCategory = DoctorCategory::all();
        $docslots = DoctorSlot::all();
        $patientVariables = $this->patientVariables();
        if (!is_null($request->get('tab'))) {
            $tab = $request->get('tab');
        } else {
            $tab = 'appointments';
        }
        return view('front.pages.patientdashboard', compact('docslots', 'doctorCategory', 'pastappmodal', 'pastapp', 'pastappall', 'todaysapp', 'doctor', 'appointment', 'paymentPlatforms', 'patientVariables', 'tab'));
    }


    public function redirect(Doctor $doctorselected, Request $request)
    {
        $doctor  = Doctor::all();
        $appointment = Appointment::all();
        $todaysapp = Appointment::where('user_id', auth()->user()->id)->where('appdate', Carbon::now()->format('Y-m-d'))->orderBy('status', 'desc')->simplePaginate(5);
        $pastapp = Appointment::where('user_id', auth()->user()->id)->where('appdate', '<', Carbon::now()->format('Y-m-d'))->orderBy('status', 'desc')->simplePaginate(5);
        $pastappall = Appointment::where('user_id', auth()->user()->id)->orderBy('status', 'desc')->simplePaginate(5);
        $pastappmodal = Appointment::where('user_id', auth()->user()->id)->where('appdate', '<', Carbon::now()->format('Y-m-d'))->orderBy('status', 'desc')->get();
        $paymentPlatforms = PaymentPlatform::all();
        $doctorCategory = DoctorCategory::all();
        $docslots = $doctorselected->slot;
        $service = $doctorselected->category->name;
        $fees = $doctorselected->fees;
        $name = $doctorselected->user->name;
        $dcrid = $doctorselected->id;
        $redirectPatientVariables = $this->redirectPatientVariables($service, $fees, $name, $dcrid);
        if (!is_null($request->get('tab'))) {
            $tab = $request->get('tab');
        } else {
            $tab = 'appointments';
        }

        return view('front.pages.redirectpatientdashboard', compact('pastappall', 'doctorselected', 'docslots', 'doctorCategory', 'pastappmodal', 'pastapp', 'todaysapp', 'doctor', 'appointment', 'paymentPlatforms', 'redirectPatientVariables', 'tab'));
    }

    function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $pastapp = Appointment::where('user_id', auth()->user()->id)->orderBy('status', 'desc')->simplePaginate(5);
            $pastappall = Appointment::where('user_id', auth()->user()->id)->orderBy('status', 'desc')->simplePaginate(5);

            return view('front.pages.past_pagination', compact('pastapp', 'pastappall'))->render();
        }
    }


    public function doctor_fetch_data(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->role == 'stuff') {
                $doctor = Doctor::where('user_id', Auth::user()->doctor_id)->first();
                $doctor_id = $doctor->id;
            } else {
                $doctor_id = Auth::user()->doctor->id;
            }
            $pastapp = Appointment::where('doctor_id', $doctor_id)->orderBy('status', 'desc')->simplePaginate(5);

            return view('front.pages.doctor_past_pagination', compact('pastapp'))->render();
        }
    }


    public function todays_fetch_data(Request $request)
    {
        $todaysapp = Appointment::where('user_id', auth()->user()->id)->where('appdate', Carbon::now()->format('Y-m-d'))->orderBy('status', 'asc')->simplePaginate(5);
        return view('front.pages.today_pagination', compact('todaysapp'))->render();
    }

    public function doctor_todays_fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $todaysapp = Appointment::where('doctor_id', auth()->user()->doctor->id)->where('appdate', Carbon::now()->format('Y-m-d'))->orderBy('status', 'desc')->simplePaginate(5);
            // $pastappreports = TestReport::where('patient_id', auth()->user()->id)->where('doctor_id', auth()->user()->doctor->id)->simplePaginate(10);
            return view('front.pages.doctor_today_pagination', compact('todaysapp'))->render();
        }
    }


    public function dashboard_fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $pastapp = Appointment::where('user_id', auth()->user()->id)->where('appdate', '<', Carbon::now()->format('Y-m-d'))->orderBy('status', 'desc')->simplePaginate(5);
            // $pastappreports = TestReport::where('patient_id', auth()->user()->id)->where('doctor_id', auth()->user()->doctor->id)->simplePaginate(10);

            return view('front.pages.dashboardpagi', compact('pastapp'))->render();
        }
    }

    public function doctor_dashboard_fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $todaysapp = Appointment::where('doctor_id', auth()->user()->doctor->id)->where('appdate', Carbon::now()->format('Y-m-d'))->orderBy('status', 'desc')->simplePaginate(5);

            return view('front.pages.doctordashboardpagi', compact('todaysapp'))->render();
        }
    }

    public function doctorindex(Request $request)
    {
        
        $doctorCategory = Doctor::where('user_id', auth()->user()->doctor->id)->select('category_id')->get();
        // $data['doctorids'] = Doctor::where('user_id', auth()->user()->doctor->id)->get();
        
            $appointment = Appointment::query();
            $data['newAppointment'] = Appointment::where('doctor_id', auth()->user()->doctor->id)->whereDate('created_at', '>=', Carbon::today()->subDays(7))->count();

            $data['pendingAppointment'] = Appointment::where('doctor_id', auth()->user()->doctor->id)->whereDate('created_at', '<', Carbon::today())->count();

            $data['todayrequest'] = Appointment::where('doctor_id', auth()->user()->doctor->id)
                ->with('patient')
                ->where('status', 0)
                ->orderBy('id', 'desc')
                ->get();

            $data['totalpatient'] = $collection = Appointment::where('doctor_id', auth()->user()->doctor->id)->select('user_id')->distinct()->get()->count();
            $data['totalpatientmonth'] = Appointment::where('doctor_id', auth()->user()->doctor->id)->select('user_id')->whereMonth('appdate', now()->month)->distinct()->get()->count();

            $data['patient']  = User::where('role', 'patient')->orderBy('id', 'desc')->get();
            $data['totalearningmonth'] = Appointment::where('doctor_id', auth()->user()->doctor->id)->whereMonth('appdate', now()->month)->where('paymentmethod', '!=', 'cod')->sum('fees');
            $data['total_online_earning_month'] = Appointment::where('doctor_id', auth()->user()->doctor->id)->where('paymentmethod', '!=', 'cod')->whereMonth('appdate', now()->month)->sum('fees');
            // $data['total_offline_earning_month'] = Appointment::where('doctor_id', auth()->user()->doctor->id)->where('paymentmethod', 'cod')->whereMonth('appdate', now()->month)->sum('fees');

            $data['appointment'] = Appointment::all();

            $data['todaysapp'] = Appointment::where('doctor_id', auth()->user()->doctor->id)->where('appdate', Carbon::now()->format('Y-m-d'))->where('status', '!=', 0)->with('patient', 'slot', 'doctor')->orderBy('id', 'desc')->simplePaginate(5);

            $data['pastapp'] = Appointment::where('doctor_id', auth()->user()->doctor->id)->orderBy('status', 'desc')->simplePaginate(5);

            $data['pastappModal'] = Appointment::where('doctor_id', auth()->user()->doctor->id)->where('status', 2)->orWhere('appdate', '<', Carbon::now()->format('Y-m-d'))->orderBy('status', 'desc')->with('prescription')->get();

            // $data['reportappModal'] = Appointment::where('doctor_id', auth()->user()->doctor->id)->where('status', 2)->orWhere('appdate', '<', Carbon::now()->format('Y-m-d'))->orderBy('status', 'desc')->with('prescription')->get();

            $data['doctorVariables'] = $this->doctorVariables();
            $data['docslots'] = DoctorSlot::all();
            $data['stuffs'] = User::where('role', 'stuff')->where('doctor_id', Auth::id())->get();

            if (!is_null($request->get('tab'))) {
                $data['tab'] = $request->get('tab');
            } else {
                $data['tab'] = 'dashboard';
            }
            // return 'hello';
            return view('front.pages.doctordashboard', $data);                      

        
       
        
    }

    public function doctorZoomCreateLink(Request $request)
    {
        $meeting_create = $this->create($request->all());
        $meeting = $meeting_create['data'];
        $meeting_id = (string)$meeting['id'];
        if ($meeting_create['success'] == true) {
            $meeting_store = Meeting::create([
                'topic' => $meeting['topic'],
                'meeting_id' => $meeting_id,
                'join_url' => $meeting['start_url'],
                'password' => $meeting['password'],
                'appointment_id' => $request->appointment_id,
                'doctor_id' => $request->doctor_id,
                'user_id' => $request->user_id,
            ]);
            if (!empty($meeting_store)) {
                return redirect()->back()->with('success', 'A meeting is created by you.');
            }
            return redirect()->back()->with('error', __('Meeting not initialized!'));
        }
        return redirect()->back()->with('error', __('Something went wrong'));
    }

    public function setPaymentType(Request $request)
    {
        Session::forget('payment_type');
        Session::put('payment_type', $request->payment_type);
        $paymentPlatforms = PaymentPlatform::all();
        $payment_type = $request->payment_type;
        return view('front.include.payment', compact('paymentPlatforms', 'payment_type'));
    }

    public function financialReport()
    {
        if (Auth::user()->role == 'stuff') {
            $doctor = Doctor::where('user_id', Auth::user()->doctor_id)->first();
            $doctor_id = $doctor->id;
        } else {
            $doctor_id = Auth::user()->doctor->id;
        }
        $appointment = Appointment::where('doctor_id', $doctor_id)->where('status', 2)->with('patient');
        $current_month = Carbon::now()->format('m');

        $data['first_month'] = Appointment::where('doctor_id', $doctor_id)->where('status', 2)->with('patient')->whereMonth('appdate', previousMonthId($current_month, 0))->whereYear('appdate', previousYear($current_month, 0))->get();
        $data['second_month'] = Appointment::where('doctor_id', $doctor_id)->where('status', 2)->with('patient')->whereMonth('appdate', previousMonthId($current_month, 1))->whereYear('appdate', previousYear($current_month, 1))->get();
        $data['third_month'] = Appointment::where('doctor_id', $doctor_id)->where('status', 2)->with('patient')->whereMonth('appdate', previousMonthId($current_month, 2))->whereYear('appdate', previousYear($current_month, 2))->get();
        $data['fourth_month'] = Appointment::where('doctor_id', $doctor_id)->where('status', 2)->with('patient')->whereMonth('appdate', previousMonthId($current_month, 3))->whereYear('appdate', previousYear($current_month, 3))->get();
        $data['fifth_month'] = Appointment::where('doctor_id', $doctor_id)->where('status', 2)->with('patient')->whereMonth('appdate', previousMonthId($current_month, 4))->whereYear('appdate', previousYear($current_month, 4))->get();
        $data['sixth_month'] = Appointment::where('doctor_id', $doctor_id)->where('status', 2)->with('patient')->whereMonth('appdate', previousMonthId($current_month, 5))->whereYear('appdate', previousYear($current_month, 5))->get();
        $data['seventh_month'] = Appointment::where('doctor_id', $doctor_id)->where('status', 2)->with('patient')->whereMonth('appdate', previousMonthId($current_month, 6))->whereYear('appdate', previousYear($current_month, 6))->get();
        $data['eighth_month'] = Appointment::where('doctor_id', $doctor_id)->where('status', 2)->with('patient')->whereMonth('appdate', previousMonthId($current_month, 7))->whereYear('appdate', previousYear($current_month, 7))->get();
        $data['ninth_month'] = Appointment::where('doctor_id', $doctor_id)->where('status', 2)->with('patient')->whereMonth('appdate', previousMonthId($current_month, 8))->whereYear('appdate', previousYear($current_month, 8))->get();
        $data['tenth_month'] = Appointment::where('doctor_id', $doctor_id)->where('status', 2)->with('patient')->whereMonth('appdate', previousMonthId($current_month, 9))->whereYear('appdate', previousYear($current_month, 9))->get();
        $data['eleventh_month'] = Appointment::where('doctor_id', $doctor_id)->where('status', 2)->with('patient')->whereMonth('appdate', previousMonthId($current_month, 10))->whereYear('appdate', previousYear($current_month, 10))->get();
        $data['tweleveth_month'] = Appointment::where('doctor_id', $doctor_id)->where('status', 2)->with('patient')->whereMonth('appdate', previousMonthId($current_month, 11))->whereYear('appdate', previousYear($current_month, 11))->get();
        $pdf = PDF::loadView('front.pages.financial-report-pdf', $data);
        return $pdf->download(time() . '.pdf');
    }

    public function appointmentReceipt($appointment_id)
    {
        $appointment = Appointment::whereId($appointment_id)->with('patient', 'doctor', 'doctor.user')->first();
        $pdf = PDF::loadView('front.pages.appointment-receipt', compact('appointment'));
        return $pdf->download(time() . '.pdf');
    }
}
