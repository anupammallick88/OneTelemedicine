<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Models\Appointment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class SslCommerzPaymentController extends Controller
{
    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $app = Appointment::where('charge_id', $tran_id)->first();

        if ($app) {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $app->update(['is_paid' => 1]);

                Session::flash('success', __('Appointment Created Successfully'));
                return redirect()->route('patient.dashboard');
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $app->update(['is_paid' => 0]);
                Session::flash('error', __('Appointment not paid'));
                return redirect()->route('patient.dashboard');
            }
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            Session::flash('error', __('Something Went Wrong'));
            return redirect()->route('patient.dashboard');
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $app = Appointment::where('charge_id', $tran_id)->first();

        if ($app) {
            $app->update(['is_paid' => '0']);
            Session::flash('error', __('Appointment not paid'));
            return redirect()->route('patient.dashboard');
        } else {
            Session::flash('error', __('Something Went Wrong'));
            return redirect()->route('patient.dashboard');
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $app = Appointment::where('charge_id', $tran_id)->first();

        if ($app) {
            $app->update(['is_paid' => '0']);
            Session::flash('error', __('Appointment not paid'));
            return redirect()->route('patient.dashboard');
        } else {
            Session::flash('error', __('Something Went Wrong'));
            return redirect()->route('patient.dashboard');
        }
    }

    public function ipn(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $app = Appointment::where('charge_id', $tran_id)->first();

        if ($app) {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $app->update(['is_paid' => 1]);

                Session::flash('success', __('Appointment Created Successfully'));
                return redirect()->route('patient.dashboard');
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $app->update(['is_paid' => 0]);
                Session::flash('error', __('Appointment not paid'));
                return redirect()->route('patient.dashboard');
            }
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            Session::flash('error', __('Something Went Wrong'));
            return redirect()->route('patient.dashboard');
        }
    }
}
