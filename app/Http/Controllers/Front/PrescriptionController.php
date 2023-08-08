<?php

namespace App\Http\Controllers\Front;

use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Models\TestPrescription;
use App\Models\Models\Appointment;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\DB;
use Mews\Purifier\Facades\Purifier;

class PrescriptionController extends Controller
{
    public function prescription(Request $request, Appointment $appointment)
    {
        $this->validate($request, [
            'MedicineName' => 'required'
        ]);
        try {
            $prescription = Prescription::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $appointment->patient->id,
                'patient_weight' => Purifier::clean($request->patient_weight),
                'patient_bp' => Purifier::clean($request->PatientBP),
                'patient_temperature' => Purifier::clean($request->PatientTemperature),
                'advice' => Purifier::clean($request->advice),
                'patient_age' => Purifier::clean($request->patient_age),
                'medicine_name' => json_encode($request->MedicineName),
                'medicine_type' => json_encode($request->type),
                'medicine_quantity' => json_encode($request->mg),
                'medicine_dose' => json_encode($request->Dose),
                'medicine_day' => json_encode($request->Day),
                'medicine_comment' => json_encode($request->Comment),
            ]);
            if ($request->has('testname')) {
                foreach ($request->testname as $i => $testname) {
                    $testprescription = TestPrescription::create([
                        'appointment_id' => $appointment->id,
                        'patient_id' => $appointment->patient->id,
                        'test_name' => Purifier::clean($testname),
                        'test_comment' => Purifier::clean($request->testcomment[$i]),
                    ]);
                }
            }
            Appointment::whereId($appointment->id)->update([
                'status' => 2,
            ]);
            Toastr::success('message', __('Prescription Successfully Created'));
            return redirect()->back()->with('success', 'Prescription Successfully Created');
        } catch (Exception $e) {
            Toastr::error('message', __('Something Went Wrong'));
            return redirect()->back()->with('error', 'Something Went Wrong');
        }


        foreach ($request->MedicineName as $i => $medicine) {

            $prescription = Prescription::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $appointment->patient->id,
                'patient_weight' => Purifier::clean($request->patient_weight),
                'medicine_name' => Purifier::clean($medicine),
                'patient_bp' => Purifier::clean($request->PatientBP),
                'patient_temperature' => Purifier::clean($request->PatientTemperature),
                'advice' => Purifier::clean($request->advice),
            ]);


            $prescription->update([
                'medicine_type' => Purifier::clean($request->type[$i])
            ]);

            $prescription->update([
                'medicine_quantity' => Purifier::clean($request->mg[$i])
            ]);

            $prescription->update([
                'medicine_dose' => Purifier::clean($request->Dose[$i])
            ]);

            $prescription->update([
                'medicine_day' => Purifier::clean($request->Day[$i])
            ]);

            $prescription->update([
                'medicine_comment' => Purifier::clean($request->Comment[$i])
            ]);
        }

        if ($request->has('testname')) {
            foreach ($request->testname as $i => $testname) {
                $testprescription = TestPrescription::create([
                    'appointment_id' => $appointment->id,
                    'patient_id' => $appointment->patient->id,
                    'test_name' => Purifier::clean($testname)
                ]);

                $testprescription->update([
                    'test_comment' => Purifier::clean($request->testcomment[$i])
                ]);
            }
        }

        $user = User::where('id', $prescription->patient_id)->first();

        Appointment::whereId($appointment->id)->update([
            'status' => 2,
        ]);
        Toastr::success('message', __('Prescription Successfully Created'));

        return redirect()->back();
    }

    public function update(Request $request, Appointment $appointment)
    {

        $appointment->prescription()->delete();

        foreach ($request->MedicineName as $i => $medicine) {
            $prescription = Prescription::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $appointment->patient->id,
                'medicine_name' => Purifier::clean($medicine),
                'patient_weight' => Purifier::clean($request->weight),
                'patient_bp' => Purifier::clean($request->PatientBP),
                'patient_temperature' => Purifier::clean($request->PatientTemperature),
                'patient_weight' => Purifier::clean($request->patient_weight),
                'patient_bp' => Purifier::clean($request->PatientBP),
                'advice' => Purifier::clean($request->advice),

            ]);

            $prescription->update([
                'medicine_type' => Purifier::clean($request->type[$i])
            ]);

            $prescription->update([
                'medicine_quantity' => Purifier::clean($request->mg[$i])
            ]);

            $prescription->update([
                'medicine_dose' => Purifier::clean($request->Dose[$i])
            ]);

            $prescription->update([
                'medicine_day' => Purifier::clean($request->Day[$i])
            ]);

            $prescription->update([
                'medicine_comment' => Purifier::clean($request->Comment[$i])
            ]);
        }

        $appointment->testprescription()->delete();

        if (!empty($request->testname)) {
            foreach ($request->testname as $i => $testname) {
                $testprescription = TestPrescription::create([
                    'appointment_id' => $appointment->id,
                    'patient_id' => $appointment->patient->id,
                    'test_name' => Purifier::clean($testname)
                ]);

                $testprescription->update([
                    'test_comment' => Purifier::clean($request->testcomment[$i])
                ]);
            }
        }

        Toastr::success('message', __('Prescription Updated'));

        return redirect()->back();
    }


    public function delete(Prescription $prescription)
    {
        $prescription->delete();

        Toastr::success('message', __('Successfully Deleted'));
        return redirect()->back();
    }

    public function pdf(Appointment $app)
    {
        // dd($app->doctor);
        $pdf = PDF::loadView('front.pages.pdf', compact('app'));

        return $pdf->download('prescription.pdf');
    }

    public function printpres(Appointment $app)
    {
        // dd($app->doctor);
        return view('front.pages.print', compact('app'));

        // return $pdf->download('prescription.pdf');
    }
}
