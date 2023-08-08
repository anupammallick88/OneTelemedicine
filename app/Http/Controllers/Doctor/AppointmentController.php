<?php

namespace App\Http\Controllers\Doctor;

use App\Mail\ApprovalMail;
use App\Mail\SubscriberMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Models\Earning;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function approve($appointment)
    {
        $appointment = Appointment::whereId($appointment)->with('patient')->first();
        if ($appointment->paymentmethod == 'cod') {
            $appointment->update(['is_paid' => 1]);
        }
        $haveAppointToday = Appointment::where('doctor_id', $appointment->doctor_id)->where('appdate', Carbon::now()->format('Y-m-d'))->where('status', 1)->count();
        if ($haveAppointToday == 0) {
            $appointment->update([
                'status' => 1
            ]);
            Mail::to($appointment->patient->email)->send(new ApprovalMail($appointment->id));

            session()->flash('success', __('Successfully approved'));
            Toastr::success('success', __('Successfully approved'), ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
        session()->flash('success', __('You have already patient in queue. Please take care of him/her.'));
        Toastr::success('success', __('You have already patient in queue. Please take care of him/her.'), ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function complete(Appointment $appointment)
    {
        $appointment->update([
            'status' => 2
        ]);

        session()->flash('success', __('Successfully completed'));

        Toastr::success('success', __('Successfully completed'), ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }

    public function delete(Appointment $appointment)
    {
        $appointment->delete();

        session()->flash('success', __('Successfully deleted'));

        Toastr::success('success', __('Successfully deleted'), ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }
}
