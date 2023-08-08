<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\paymentmethodsetting;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;
use Mews\Purifier\Facades\Purifier;

class PaymentMethodSettingController extends Controller
{
    public function index()
    {
        $pms = paymentmethodsetting::first();

        return view('admin.paymentmethod.index', compact('pms'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'PAYPAL_BASE_URI' => 'required|regex:/^\S*$/u',
            'PAYPAL_CLIENT_ID' => 'required|regex:/^\S*$/u',
            'PAYPAL_CLIENT_SECRET' => 'required|regex:/^\S*$/u',
            'STRIPE_KEY' => 'required|regex:/^\S*$/u',
            'STRIPE_SECRET' => 'required|regex:/^\S*$/u'
        ]);

        $smtp = paymentmethodsetting::first();
        if ($smtp) {
            $smtp->update([
                'PAYPAL_BASE_URI' => Purifier::clean($request->PAYPAL_BASE_URI),
                'PAYPAL_CLIENT_ID' => Purifier::clean($request->PAYPAL_CLIENT_ID),
                'PAYPAL_CLIENT_SECRET' => Purifier::clean($request->PAYPAL_CLIENT_SECRET),
                'STRIPE_KEY' => Purifier::clean($request->STRIPE_KEY),
                'STRIPE_SECRET' => Purifier::clean($request->STRIPE_SECRET)
            ]);
        } else {
            paymentmethodsetting::create([
                'PAYPAL_BASE_URI' => Purifier::clean($request->PAYPAL_BASE_URI),
                'PAYPAL_CLIENT_ID' => Purifier::clean($request->PAYPAL_CLIENT_ID),
                'PAYPAL_CLIENT_SECRET' => Purifier::clean($request->PAYPAL_CLIENT_SECRET),
                'STRIPE_KEY' => Purifier::clean($request->STRIPE_KEY),
                'STRIPE_SECRET' => Purifier::clean($request->STRIPE_SECRET)
            ]);
        }

        $env_val['PAYPAL_BASE_URI'] =  Purifier::clean($request->PAYPAL_BASE_URI) ?? __('YOUR_PAYPAL_BASE_URI');
        $env_val['PAYPAL_CLIENT_ID'] = Purifier::clean($request->PAYPAL_CLIENT_ID) ?? __('YOUR_PAYPAL_CLIENT_ID');
        $env_val['PAYPAL_CLIENT_SECRET'] =  Purifier::clean($request->PAYPAL_CLIENT_SECRET) ?? __('YOUR_PAYPAL_CLIENT_SECRET');
        $env_val['PAYPAL_STATUS'] =  Purifier::clean($request->PAYPAL_STATUS) ?? __('PAYPAL_STATUS');

        $env_val['STRIPE_KEY'] = Purifier::clean($request->STRIPE_KEY) ?? __('YOUR_STRIPE_KEY');
        $env_val['STRIPE_SECRET'] = Purifier::clean($request->STRIPE_SECRET) ?? __('YOUR_STRIPE_SECRET');
        $env_val['STRIPE_STATUS'] = Purifier::clean($request->STRIPE_STATUS) ?? __('STRIPE_STATUS');

        $env_val['BANK_NAME'] = Purifier::clean($request->bank_name) ?? __('BANK_NAME');
        $env_val['BANK_ACCOUNT_NAME'] = Purifier::clean($request->bank_account_name) ?? __('bank_account_name');
        $env_val['BANK_ACCOUNT_NUMBER'] = Purifier::clean($request->bank_account_number) ?? __('bank_account_number');
        $env_val['BANK_BRANCH'] = Purifier::clean($request->bank_branch) ?? __('bank_branch');
        $env_val['BANK_STATUS'] = Purifier::clean($request->bank_status) ?? __('bank_status');
        
        
        $env_val['SSLCZ_STORE_ID'] = Purifier::clean($request->sslcz_store_id) ?? __('sslcz_store_id');
        $env_val['SSLCZ_STORE_PASSWORD'] = Purifier::clean($request->sslcz_store_password) ?? __('sslcz_store_password');
        $env_val['SSLCZ_STATUS'] = Purifier::clean($request->sslcz_status) ?? __('sslcz_status');

        setEnvValue($env_val);

        Session::flash('message', __('Successfully Updated'));

        Toastr::success('message', __('Successfully Updated'));

        return redirect()->back()->with('success', __('Settings Successfully Updated'));
    }
}
