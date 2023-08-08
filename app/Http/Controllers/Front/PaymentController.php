<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Earning;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Service\PaypalService;
use App\Models\PaymentPlatform;
use App\Models\Models\Appointment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Resolvers\PaymentPlatformResolver;
use Mews\Purifier\Facades\Purifier;

class PaymentController extends Controller
{
    protected $paymentPlatformResolver;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PaymentPlatformResolver $paymentPlatformResolver)
    {
        $this->middleware('auth')->except('cancelled');

        $this->paymentPlatformResolver = $paymentPlatformResolver;


    }

    public function index()
    {
        Appointment::first()->delete();
        return redirect(route('patient.dashboard'));
    }

    public function appointment($request)
    {
        $gd = Carbon::parse($request->appdate);
        $today = Carbon::now();

        if ($gd->gt($today) || $gd->isSameDay($today)) {

            $create = Appointment::create([
                'appdate' => Purifier::clean($request->appdate),
                'apptime' => Purifier::clean($request->apptime),
                'doctorsService' => Purifier::clean($request->doctorsService),
                'doctor_id' => Purifier::clean($request->selectdoctory), //doctor id
                'user_id' => Auth::user()->id,
                'paymentmethod' => Purifier::clean($request->paymentmethod),
                'comment' => Purifier::clean($request->comment),
                'slot_id' => Purifier::clean($request->slot_id),
                'fees' => $request->appinput,
                'type' => $request->appointment_type,
            ]);

            Earning::create([
                'doctor_id' => Purifier::clean($request->selectdoctory), //doctor id
                'user_id' => Auth::user()->id,
                'earning' => Purifier::clean($request->appinput)
            ]);

            return $create->id;

        } else {
            Session::flash('success', __('Please select today or future availabe date of that doctor'));
            Toastr::success(__('Please select today or future availabe date of that doctor'));

            return redirect()->route('patient.dashboard');
        }
    }

    public function payOffline(Request $request)
    {
        $gd = Carbon::parse($request->appdate);
        $today = Carbon::now();

        if ($gd->gt($today) || $gd->isSameDay($today)) {

            Appointment::create([
                'appdate' => Purifier::clean($request->appdate),
                'apptime' => Purifier::clean($request->apptime),
                'doctorsService' => Purifier::clean($request->doctorsService),
                'doctor_id' => Purifier::clean($request->selectdoctory), //doctor id
                'user_id' => Auth::user()->id,
                'paymentmethod' => 'cod',
                'comment' => Purifier::clean($request->comment),
                'slot_id' => Purifier::clean($request->slot_id),
                'fees' => $request->appinput,
                'type' => $request->appointment_type,
            ]);

            Earning::create([
                'doctor_id' => Purifier::clean($request->selectdoctory), //doctor id
                'user_id' => Auth::user()->id,
                'earning' => Purifier::clean($request->appinput)
            ]);
            return redirect()->route('patient.dashboard')->with('success', 'Appointment created successfully');

        } else {
            Session::flash('success', __('Please select today or future availabe date of that doctor'));
            Toastr::success(__('Please select today or future availabe date of that doctor'));

            return redirect()->route('patient.dashboard');
        }
    }

    public function pay(Request $request)
    {
        if($request->payment_type == 'offline') {
            return $this->payOffline($request);
        }else {
            $create = $this->appointment($request);
            Session::put('appointment_create_id', $create);
            $rules = [
                'value' => ['required', 'numeric', 'min:5'],
                'currency' => ['required', 'exists:currencies,iso'],
                'payment_platform' => ['required', 'exists:payment_platforms,id']
            ];

            $request->validate($rules);

            $paymentPlatform = $this->paymentPlatformResolver
                ->resolveService($request->payment_platform);
            session()->put('paymentPlatformId', $request->payment_platform);

            return $paymentPlatform->handlePayment($request);
        }

    }

    public function approval()
    {
        if(session()->has('paymentPlatformId')) {

            $paymentPlatform = $this->paymentPlatformResolver
                                    ->resolveService(session()->get('paymentPlatformId'));

            return  $paymentPlatform->handleApproval();
        }

        return response('Error');
    }

    public function cancelled()
    {
        Appointment::first()->delete();
        return redirect()->route('paypalhome')->withErrors(__('Payment is cancelled'));
    }
}
