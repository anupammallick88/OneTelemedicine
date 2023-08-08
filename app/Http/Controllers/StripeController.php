<?php

namespace App\Http\Controllers;

use App\Models\Models\Appointment;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

use Stripe;
use Session;

class StripeController extends Controller
{
    public function makePayment(Request $request)
    {
        $appId = Session::get('appointment_create_id');

        $app = Appointment::where('id', $appId)->first();
        $app->update(['is_paid' => 1]);
        Session::forget('appointment_create_id');

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => 120 * 100,
            "currency" => "inr",
            "source" => $request->stripeToken,
            "description" => "Make payment and chill."
        ]);


        Session::flash('success', __('Appointment Created Successfully'));
        Toastr::success(__('Appointment Created Successfully'));
        return redirect()->route('patient.dashboard');
    }
}
