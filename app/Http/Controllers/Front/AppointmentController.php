<?php

namespace App\Http\Controllers\Front;

use App\Mail\CancelAppointment;
use App\Resolvers\PaymentPlatformResolver;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use App\Models\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\BankDeposite;
use App\Models\TestReport;
use App\Models\Earning;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Mews\Purifier\Facades\Purifier;

use App\Http\Requests;
use Validator;
use URL;
use Redirect;
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

class AppointmentController extends Controller
{
    protected $paymentPlatformResolver;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $_api_context;

    public function __construct(PaymentPlatformResolver $paymentPlatformResolver)
    {
        $this->middleware('auth')->except('cancelled');

        $this->paymentPlatformResolver = $paymentPlatformResolver;

        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    public function appointment(Request $request)
    {
        $this->validate($request, [
            'doctor_get_fees' => 'required',
            'slot_id' => 'required',
            'appinput' => 'required',
            'appdate' => 'required',
            'apptime' => 'required',
            'DoctorsService' => 'required',
            'payment_type' => 'required',
            'selectdoctory' => 'required',
            'comment' => 'required',
            'payment_method' => 'required',
        ]);

        try {
            if ($request->payment_method == 'Stripe') {
                $id = $this->store($request);
                Session::put('appointment_create_id', $id);

                return view('stripe');

                Session::flash('success', __('Appointment Created Successfully'));
                Toastr::success(__('Appointment Created Successfully'));
                return redirect()->route('patient.dashboard');
            } else if ($request->payment_method == 'Paypal') {

                $payer = new Payer();
                $payer->setPaymentMethod('paypal');

                $item_1 = new Item();
                $item_1->setName('Product 1')
                    ->setCurrency('INR')
                    ->setQuantity(1)
                    ->setPrice($request->doctor_get_fees);

                $item_list = new ItemList();
                $item_list->setItems(array($item_1));

                $amount = new Amount();
                $amount->setCurrency('INR')
                    ->setTotal($request->doctor_get_fees);

                $transaction = new Transaction();
                $transaction->setAmount($amount)
                    ->setItemList($item_list)
                    ->setDescription('Enter Your transaction description');

                $redirect_urls = new RedirectUrls();
                $redirect_urls->setReturnUrl(URL::route('status'))
                    ->setCancelUrl(URL::route('status'));

                $payment = new Payment();
                $payment->setIntent('Sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));
                try {
                    $payment->create($this->_api_context);
                } catch (\PayPal\Exception\PPConnectionException $ex) {
                    if (Config::get('app.debug')) {
                        Session::flash('error', 'Connection timeout');
                        return redirect()->route('patient.dashboard');
                    } else {
                        Session::flash('error', 'Some error occur, sorry for inconvenient');
                        return redirect()->route('patient.dashboard');
                    }
                }

                foreach ($payment->getLinks() as $link) {
                    if ($link->getRel() == 'approval_url') {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }
                // store data 
                Session::put('payment_id', $payment->getId());
                $request['charge_id'] = $payment->getId();
                $id = $this->store($request);
                Session::put('appointment_create_id', $id);

                if (isset($redirect_url)) {
                    return redirect()->away($redirect_url);
                }

                Session::flash('error', 'Unknown error occurred');
                return redirect()->route('patient.dashboard');
            } else if ($request->payment_method == 'sslcommerz') {

                $post_data = array();
                $post_data['total_amount'] = $request->doctor_get_fees; //'10'; # You cant not pay less than 10
                $post_data['currency'] = "BDT";
                $post_data['tran_id'] = uniqid(); // tran_id must be unique

                # CUSTOMER INFORMATION
                $post_data['cus_name'] = Auth::user()->name;
                $post_data['cus_email'] = Auth::user()->email;
                $post_data['cus_add1'] = Auth::user()->address;
                $post_data['cus_add2'] = "";
                $post_data['cus_city'] = "";
                $post_data['cus_state'] = "";
                $post_data['cus_postcode'] = "";
                $post_data['cus_country'] = "Bangladesh";
                $post_data['cus_phone'] = '8801XXXXXXXXX';
                $post_data['cus_fax'] = "";

                # SHIPMENT INFORMATION
                $post_data['ship_name'] = "Store Test";
                $post_data['ship_add1'] = "Dhaka";
                $post_data['ship_add2'] = "Dhaka";
                $post_data['ship_city'] = "Dhaka";
                $post_data['ship_state'] = "Dhaka";
                $post_data['ship_postcode'] = "1000";
                $post_data['ship_phone'] = "";
                $post_data['ship_country'] = "Bangladesh";

                $post_data['shipping_method'] = "NO";
                $post_data['product_name'] = "Computer";
                $post_data['product_category'] = "Goods";
                $post_data['product_profile'] = "physical-goods";

                # OPTIONAL PARAMETERS
                $post_data['value_a'] = "ref001";
                $post_data['value_b'] = "ref002";
                $post_data['value_c'] = "ref003";
                $post_data['value_d'] = "ref004";

                $request['charge_id'] = $post_data['tran_id'];

                $id =  $this->store($request);

                $sslc = new SslCommerzNotification();
                # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
                $payment_options = $sslc->makePayment($post_data, 'hosted');

                if (!is_array($payment_options)) {
                    print_r($payment_options);
                    $payment_options = array();
                }
            } else if ($request->payment_method == 'cod') {
                $id =  $this->store($request);
                Session::flash('success', __('Appointment Created Successfully'));
                Toastr::success(__('Appointment Created Successfully'));
                return redirect()->route('patient.dashboard');
            } else if ($request->payment_method == 'Bank') {
                if ($request->has('bank_deposite_slip') && $request->has('bank_deposite_by')) {
                    $id =  $this->store($request);
                    Session::flash('success', __('Appointment Created Successfully! Wait for Approve'));
                    Toastr::success(__('Appointment Created Successfully'));
                    return redirect()->route('patient.dashboard');
                } else {
                    Session::flash('error', __('Please Enter Valid Bank Information'));
                    return redirect()->route('patient.dashboard');
                }
            } else {
                Session::flash('error', __('Sothing Went Wrong'));
                return redirect()->route('patient.dashboard');
            }
        } catch (Exception $e) {
            dd($e);
            Session::flash('success', __('Sothing Went Wrong'));
            Toastr::warning(__('Sothing Went Wrong'));
            return redirect()->route('patient.dashboard');
        }
    }

    public function store(Request $request)
    {
        try {            

            $app = Appointment::create([
                'appdate' => Purifier::clean($request->appdate),
                'apptime' => Purifier::clean($request->apptime),
                'doctorsService' => Purifier::clean($request->DoctorsService),
                'doctor_id' => $request->selectdoctory, //doctor id
                'user_id' => Auth::user()->id,
                'paymentmethod' => $request->payment_method,
                'charge_id' => $request->charge_id,
                'comment' => Purifier::clean($request->comment),
                'slot_id' => $request->slot_id,
                'fees' => $request->doctor_get_fees,                
                'type' => $request->payment_type == 'online' ? 1 : 0,
            ]);

            if($request->hasfile('report')) {
                foreach($request->file('report') as $file)
                {
                    // $name = $file->getClientOriginalName();
                    
                    $name = uniqid(11) . "." . $file->getClientOriginalExtension();
                    $file->move(public_path().'/testreports/', $name);  
                    // TestReport::create([
                    //     'appointment_id' => $app->id,
                    //     'patient_id' => Auth::user()->id,
                    //     'doctor_id' => $request->selectdoctory,
                    //     'test_file' => $name,
                    // ]);
                    $data[] = $name;  
                }
                $appid = $app->id;
                $patient = Auth::user()->id;
                $doctor = $request->selectdoctory;
                $fileModal = new TestReport();
                $fileModal->appointment_id = $appid;
                $fileModal->patient_id = $patient;
                $fileModal->doctor_id = $doctor;
                $fileModal->test_file = json_encode($data);
                $fileModal->save();               
               
            } 

            if ($request->payment_method == 'Bank') {
                $slip = fileUpload($request['bank_deposite_slip'], BANK_SLIP); // upload file
                BankDeposite::create([
                    'appointment_id' => $app->id,
                    'bank_deposite_by' => $request->bank_deposite_by,
                    'bank_deposite_slip' => $slip,
                ]);
            } else {
                if ($request->payment_method == 'cod') {
                    // $app->update([
                    //     'is_paid' => 1
                    // ]);
                } else {
                    Earning::create([
                        'doctor_id' => $request->selectdoctory, //doctor id
                        'user_id' => Auth::user()->id,
                        'earning' => $request->appinput
                    ]);
                }
            }
            return $app->id;
        } catch (Exception $e) {
            // dd($e);
            return false;
        }
    }


    public function deleteappointment(Appointment $appointment)
    {
        $appointment->delete();

        session()->flash('success', __('Successfully Deleted'));

        Toastr::success('', __('Successfully deleted'), ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }

    public function cancelAppointment($appointment_id, Request $request)
    {
        $appointment = Appointment::whereId($appointment_id)->with('patient')->first();
        if ($appointment->status == 3) {
            return redirect()->back()->with('error', 'Appointment is already canceled!');
        }
        if ($appointment->paymentmethod == 'stripe' && $appointment->charge_id != null) {
            $stripeSecret = config('services.stripe.stripe_secret');
            $stripe = Stripe::make($stripeSecret);
            $refund = $stripe->refunds()->create($appointment->charge_id);
        } elseif ($appointment->paymentmethod == 'paypal' && $appointment->charge_id != null) {
            $paymentPlatform = $this->paymentPlatformResolver
                ->resolveService(1);
            $refund = $paymentPlatform->refundApproval($appointment->charge_id);
        }
        Mail::to($appointment->patient->email)->send(new CancelAppointment($request->reason));
        $succdata = $appointment->update([
            'status' => 3,
            'cancel_reason' => $request->reason,
        ]);

        if ($succdata) {
            session()->flash('success', __('Successfully Canceled'));

            return redirect()->back();
        }
    }
}
