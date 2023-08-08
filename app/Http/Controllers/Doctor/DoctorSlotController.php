<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddSlotRequest;
use App\Models\Doctor;
use App\Models\DoctorSlot;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Transactions\DbTransactionHandler;

class DoctorSlotController extends Controller
{
    public function index()
    {
        $docslots = DoctorSlot::all();
        return view('admin.slot.index', compact('docslots'));
    }

    public function store(AddSlotRequest $request)
    {
        DoctorSlot::create(Purifier::clean($request->all()));
        session()->flash('success', __('Successfully Created'));
        Toastr::success('success', __('Successfully Created'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('slot.index');
    }

    public function editslot($id)
    {
        $docslot = DoctorSlot::findOrFail($id);
        return view('admin.slot.edit', compact('docslot'));
    }

    public function updateslot(Request $request, $id)
    {
        $docslot = DoctorSlot::findOrFail($id);
        $docslot->update(Purifier::clean($request->all()));
        session()->flash('success', __('Successfully Updated'));
        Toastr::success('success', __('Successfully Updated'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('slot.index');
    }

    public function deleteslot($id)
    {
        try {
            DoctorSlot::findOrFail($id)->delete();
            DB::table('doctor_doctor_slot')->where('doctor_slot_id', $id)->delete();
            session()->flash('success', __('Successfully Deleted'));
            Toastr::success('success', __('Successfully Deleted'), ["positionClass" => "toast-top-right"]);
            return redirect()->route('slot.index');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function adddoctortoslot()
    {
        $docslots = DoctorSlot::orderBy('start_time')->get();
        $doctors = Doctor::all();
        return view('admin.slot.add', compact('docslots', 'doctors'));
    }

    public function createdoctorslot(Request $request)
    {
        $doctor = Doctor::findOrFail($request->doctor_id);
        $slot = DoctorSlot::findOrFail($request->slot_id);

        $doctor->slot()->syncWithoutDetaching($request->slot_id);
        session()->flash('success', __('Successfully Updated'));
        Toastr::success('success', __('Successfully Updated'), ["positionClass" => "toast-top-right"]);
        return back();
    }
    public function deletedoctorslot($id)
    {
        DB::table('doctor_doctor_slot')->where('doctor_slot_id', $id)->delete();
        session()->flash('success', __('Successfully Deleted'));
        Toastr::success('success', __('Successfully Deleted'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('slot.add');
    }
}
