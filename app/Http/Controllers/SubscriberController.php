<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Mail\SubscriberMail;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use App\DataTables\SubscriberDatatable;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\SubscriberMailRequest;
use Mews\Purifier\Facades\Purifier;

class SubscriberController extends Controller
{
    public function index(SubscriberDatatable $dataTable)
    {
        return $dataTable->render('admin.subscriber.index');
    }

    public function sendmail()
    {
        return view('admin.subscriber.mail');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:subscribers,email'
        ]);
        Subscriber::create(Purifier::clean($request->all()));

        Session::flash('success', __('Successfully subscribed'));
        Toastr::success('success', __('Successfully subscribed'));

        return redirect()->back();
    }

    public function sendMailToAll(SubscriberMailRequest $request)
    {
        $subscriber = Subscriber::all();

        $message = $request->email;
        $subject = $request->subject;

        foreach ($subscriber as $subs) {
            try {
                Mail::to($subs->email)->send(new SubscriberMail($subject, $message));
                Session::flash('success', __('Successfully Sent All the mail'));
                Toastr::success('message', __('Successfully Sent All the mail'));

                return back()->with('toast_success', __('All the mail is sent successfully'));
            } catch (\Throwable $th) {
                Session::flash('success', __('Mail Server Not Ready'));
                Toastr::success('message', __('Mail Server Not Ready'));

                return back()->with('toast_success', __('Mail Server Not Ready'));
            }
        }
    }
}
