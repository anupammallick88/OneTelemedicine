<?php

namespace App\Http\Controllers\Appointment;

use Illuminate\Http\Request;
use App\Models\Models\Appointment;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\DataTables\AppointmentDatatable;
use App\Mail\ApprovalMail;
use App\Models\Earning;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function index(AppointmentDatatable $dataTable)
    {
        return $dataTable->render('admin.appointment.index');
    }

    public function details($id)
    {
        $appointment = Appointment::with('patient', 'bank_deposite')->find($id);
        if ($appointment->paymentmethod == 'Bank') {
            return view('admin.appointment.app_details', compact('appointment'));
        }
    }

    public function app_approve($id)
    {
        $appointment = Appointment::find($id);
        $appointment->update([
            'status' => 0,
            'is_paid' => 1
        ]);
        Earning::create([
            'doctor_id' => $appointment->doctor_id, //doctor id
            'user_id' => $appointment->user_id,
            'earning' => $appointment->fees
        ]);

        // Mail::to($appointment->patient->email)->send(new ApprovalMail($appointment->id));

        session()->flash('success', __('Successfully Paid'));
        Toastr::success('success', __('Successfully Paid'), ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function delete(Appointment $appointment)
    {
        $appointment->delete();

        session()->flash('success', __('Successfully Deleted'));

        Toastr::success('success', __('Successfully Deleted'), ["positionClass" => "toast-top-right"]);

        return back();
    }

    public function paymentToDoctor($appointment_id)
    {
        $appointment = Appointment::whereId($appointment_id)->first();
        if (!is_null($appointment)) {
            $update = $appointment->update([
                'is_paid' => 1
            ]);
            if (!is_null($update)) {
                return redirect()->back()->with('success', __('Successfully pay to doctor'));
            }
            return redirect()->back()->with('error', __('Something went wrong'));
        }
        return redirect()->back()->with('error', __('Appointment not found'));
    }
}
