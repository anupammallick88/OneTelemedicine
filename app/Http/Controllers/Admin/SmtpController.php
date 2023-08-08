<?php

namespace App\Http\Controllers\Admin;

use App\Models\Smtp;
use Illuminate\Http\Request;
use App\Http\Requests\SmtpRequest;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mews\Purifier\Facades\Purifier;

class SmtpController extends Controller
{
    function index()
    {
        $smtp = Smtp::first();
        return view('admin.smtp.index', compact('smtp'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'MAIL_MAILER' => 'required|regex:/^\S*$/u',
            'MAIL_HOST' => 'required|regex:/^\S*$/u',
            'MAIL_PORT' => 'required|regex:/^\S*$/u',
            'MAIL_USERNAME' => 'required|regex:/^\S*$/u',
            'MAIL_FROM_ADDRESS' => 'required|regex:/^\S*$/u',
            'MAIL_PASSWORD' => 'required|regex:/^\S*$/u',
            'MAIL_ENCRYPTION' => 'required|regex:/^\S*$/u',
        ]);

        $smtp = Smtp::first();
        if ($smtp) {
            $smtp->update([
                'MAIL_MAILER' => Purifier::clean($request->MAIL_MAILER),
                'MAIL_HOST' => Purifier::clean($request->MAIL_HOST),
                'MAIL_PORT' => Purifier::clean($request->MAIL_PORT),
                'MAIL_USERNAME' => Purifier::clean($request->MAIL_USERNAME),
                'MAIL_FROM_ADDRESS' => Purifier::clean($request->MAIL_FROM_ADDRESS),
                'MAIL_PASSWORD' => Purifier::clean($request->MAIL_PASSWORD),
                'MAIL_ENCRYPTION' => Purifier::clean($request->MAIL_ENCRYPTION),
            ]);
        } else {
            Smtp::create([
                'MAIL_MAILER' => Purifier::clean($request->MAIL_MAILER),
                'MAIL_HOST' => Purifier::clean($request->MAIL_HOST),
                'MAIL_PORT' => Purifier::clean($request->MAIL_PORT),
                'MAIL_USERNAME' => Purifier::clean($request->MAIL_USERNAME),
                'MAIL_FROM_ADDRESS' => Purifier::clean($request->MAIL_FROM_ADDRESS),
                'MAIL_PASSWORD' => Purifier::clean($request->MAIL_PASSWORD),
                'MAIL_ENCRYPTION' => Purifier::clean($request->MAIL_ENCRYPTION),
            ]);
        }

        $env_val['MAIL_MAILER'] =  Purifier::clean($request->MAIL_MAILER) ?? __('MAIL_MAILER');
        $env_val['MAIL_HOST'] = Purifier::clean($request->MAIL_HOST) ?? __('YOUR_SMTP_MAIL_HOST');
        $env_val['MAIL_PORT'] =  Purifier::clean($request->MAIL_PORT) ?? __('YOUR_SMTP_MAIL_PORT');
        $env_val['MAIL_USERNAME'] = Purifier::clean($request->MAIL_USERNAME) ?? __('YOUR_SMTP_MAIL_USERNAME');
        $env_val['MAIL_FROM_ADDRESS'] = Purifier::clean($request->MAIL_FROM_ADDRESS) ?? __('YOUR_SMTP_MAIL_FROM_ADDRESS');
        $env_val['MAIL_PASSWORD'] =  Purifier::clean($request->MAIL_PASSWORD) ? Purifier::clean($request->MAIL_PASSWORD) : __('YOUR_SMTP_MAIL_USERNAME_PASSWORD');
        $env_val['MAIL_ENCRYPTION'] =  Purifier::clean($request->MAIL_ENCRYPTION) ?? __('YOUR_SMTP_MAIL_ENCRYPTION');

        setEnvValue($env_val);

        Session::flash('success', __('Successfully Updated'));

        Toastr::success('success', __('Successfully Updated'));

        return redirect()->back()->with('success', __('Settings successfully Updated'));
    }

    public function zoom_setting()
    {
        return view('admin.smtp.zoom_setting');
    }

    public function zoom_setting_update(Request $request)
    {
        $request->validate([
            'ZOOM_API_KEY' => 'required|regex:/^\S*$/u',
            'ZOOM_API_SECRET' => 'required|regex:/^\S*$/u',
        ]);
        $env_val['ZOOM_API_KEY'] =  Purifier::clean($request->ZOOM_API_KEY) ?? __('ZOOM_API_KEY');
        $env_val['ZOOM_API_SECRET'] =  Purifier::clean($request->ZOOM_API_SECRET) ?? __('ZOOM_API_SECRET');

        setEnvValue($env_val);

        Session::flash('success', __('Zoom Setting Updated Successfully'));

        Toastr::success('success', __('Zoom Setting Updated Successfully'));

        return redirect()->route('zoom.setting.index');
    }
}
