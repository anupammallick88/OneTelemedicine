<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Models\Appointment;
use Illuminate\Http\Request;
use Validator;
use URL;
use Illuminate\Support\Facades\Session;
use Redirect;
use Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaypalController extends Controller
{
    private $_api_context;
    
    public function __construct()
    {
            
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    public function getPaymentStatus(Request $request)
    {        
        $payment_id = Session::get('payment_id');
        $appId = Session::get('appointment_create_id');

        Session::forget('payment_id');
        Session::forget('appointment_create_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            Session::flash('error','Payment failed');
            return redirect()->route('patient.dashboard');
        }
        $payment = Payment::get($payment_id, $this->_api_context);        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));        
        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') {  
            $app = Appointment::where('id', $appId)->first();
            $app->update(['is_paid' => 1]);       
            Session::flash('success','Appointment Created Successfully!');
            return redirect()->route('patient.dashboard');
        }

        Session::flash('error','Payment failed!');
		return redirect()->route('patient.dashboard');
    }
}