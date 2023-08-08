<?php

namespace App\Http\Controllers\Front;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Earning;
use App\Models\Payment;
use App\Models\Appointment;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commission;
use Brian2694\Toastr\Facades\Toastr;
use App\Notifications\DoctorNotification;
use Illuminate\Support\Facades\Validator;
use App\Notifications\AppointmentNotification;
use Mews\Purifier\Facades\Purifier;
use Symfony\Component\HttpFoundation\Response;

class StripeController extends Controller
{

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), []);

        $validation = [
            'card_no' => 'required',
            'exp_month' => 'required',
            'exp_year' => 'required',
            'cvv' => 'required',
            'amount' => 'required',
        ];

        $this->validate($request, $validation);
        $stripeSecret = config('services.stripe.stripe_secret');
        $stripe = Stripe::make($stripeSecret);
        try {
            $token = $stripe->tokens()->create([
                'card' => [
                    'number'    => Purifier::clean($request->get('card_no')),
                    'exp_month' => Purifier::clean($request->get('exp_month')),
                    'exp_year'  => Purifier::clean($request->get('exp_year')),
                    'cvc'       => Purifier::clean($request->get('cvv')),
                ],
            ]);
            if (!isset($token['id'])) {
                \Session::put('error', __('The Stripe Token was not generated correctly'));
                return "stripe token";
            }
            $charge = $stripe->charges()->create([
                'card' => $token['id'],
                'currency' => 'USD',
                'amount'   => Purifier::clean($request->get('amount')),
                'description' => 'Add in wallet',
            ]);

            if ($charge['status'] == 'succeeded') {

                Toastr::success('message', __('Successfully Appointment Created, Please wait for doctor approval'));

                return Response($charge['id'], Response::HTTP_ACCEPTED);
            } else {
                return Response(__('Payment Error'), Response::HTTP_BAD_REQUEST);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            return $e->getMessage();
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            return $e->getMessage();
        }
    }
}
