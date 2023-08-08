<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Traits\ConsumesExternalServices;

class PaypalService
{
    use ConsumesExternalServices;

    protected $baseUri;

    protected $clientId;

    protected $clientSecret;

    public function __construct()
    {
        $this->baseUri = config('services.paypal.base_uri');
        $this->clientId = config('services.paypal.client_id');
        $this->clientSecret = config('services.paypal.client_secret');
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function resolveAccessToken()
    {
        $credentials = base64_encode("{$this->clientId}:{$this->clientSecret}");

        return "Basic {$credentials}";
    }

    public function handlePayment(Request $request)
    {
        $order = $this->createOrder($request->value, $request->currency);

        $orderLinks = collect($order->links);

        $approve = $orderLinks->where('rel', 'approve')->first();

        session()->put('approvalId', $order->id);

        return redirect($approve->href);
    }

    public function handleApproval()
    {
        if (session()->has('approvalId')) {

            $approvalId = session()->get('approvalId');

            $payment = $this->capturePayment($approvalId);

            $name = $payment->payer->name->given_name;

            $charge_id = $payment->purchase_units[0]->payments->captures[0]->id;

            $payment = $payment->purchase_units[0]->payments->captures[0]->amount;

            $amount = $payment->value;

            $currency = $payment->currency_code;

            session()->put('paypal_charge_id', $charge_id);

            $appointment_cap = Appointment::whereId(Session::get('appointment_create_id'))->first();
            $appointment_cap->update([
                'charge_id' => $charge_id,
            ]);

            Session::flash('success', __('Appointment created successfully, please wait for Doctor approval'));

            return redirect()->route('patient.dashboard');
        }
        Appointment::first()->delete();
        return redirect()->route('home')->withErrors(__('We cannot capture the payment, try again,please'));
    }

    public function refundApproval($capture_id)
    {
        $this->refundPayment($capture_id);
        return 'success';
    }

    public function createOrder($value, $currency)
    {
        return $this->makeRequest(
            'POST',
            '/v2/checkout/orders',
            [],
            [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    0 => [
                        'amount' => [
                            'currency_code' => strtoupper($currency),
                            'value' => round($value * $factor = $this->resolveFactor($currency)) / $factor,
                        ]
                    ]
                ],
                'application_context' => [
                    'brand_name' => config('app.name'),
                    'shipping_preference' => 'NO_SHIPPING',
                    'user_action' => 'PAY_NOW',
                    'return_url' => route('approval'),
                    'cancel_url' => route('cancelled'),
                ]
            ],
            [],
            $isJsonRequest = true,
        );
    }

    public function capturePayment($approvalId)
    {
        return $this->makeRequest(
            'POST',
            "/v2/checkout/orders/{$approvalId}/capture",
            [],
            [],
            [
                'Content-Type' => 'application/json'
            ],
        );
    }

    public function refundPayment($capture_id)
    {
        return $this->makeRequest(
            'POST',
            "/v2/payments/captures/{$capture_id}/refund",
            [],
            [],
            [
                'Content-Type' => 'application/json'
            ],
        );
    }

    public function resolveFactor($currency)
    {
        $zeroDecimalCurrencies = ['JPY'];

        if (in_array(strtoupper($currency), $zeroDecimalCurrencies)) {
            return 1;
        }

        return 100;
    }
}
