<?php

namespace App\Http\Controllers\Patient;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\DataTables\PatientDatatable;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PatientRequest;
use Mews\Purifier\Facades\Purifier;
use Carbon\Carbon;

class PatientController extends Controller
{
    public function index(PatientDatatable $dataTable)
    {
        $user = User::where('role', 'patient')->get();
        return $dataTable->render('admin.patient.index', compact('user'));
    }

    public function create()
    {
        return view('admin.patient.create');
    }

    public function store(PatientRequest $request)
    {
        $dob = $request->birthday;
        $age = Carbon::parse($dob)->age;

        $user = User::create([
            'fname' => Purifier::clean($request->first_name),
            'lname' => Purifier::clean($request->last_name),
            'name' => Purifier::clean($request->first_name) . ' ' . Purifier::clean($request->last_name),
            'email' => Purifier::clean($request->email),
            'gender' => Purifier::clean($request->gender),
            'password' => Hash::make($request->password),
            'role' => 'patient',
            'status' => '1',
            'approve' => '1',
            'dob' => Purifier::clean($request->birthday),
            'qualification' => Purifier::clean($request->degree),
            'mobile' => Purifier::clean($request->mobile),
            'address' => Purifier::clean($request->address),
            'city' => Purifier::clean($request->city),
            'age' => $age,

        ]);

        session()->flash('success', __('Successfully Created'));

        Toastr::success('success', __('Successfully Created'), ["positionClass" => "toast-top-right"]);

        return redirect()->route('patient.index');
    }

    public function show(User $user)
    {
        return view('admin.patient.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        if ($request->password) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($user->id),
                ],
                'password' => [
                    'string',
                    'min:6',
                    'confirmed',
                ],
            ]);
        } else {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($user->id),
                ],
            ]);
        }

        $dob = $request->birthday;
        $age = Carbon::parse($dob)->age;

        $user->update([
            'fname' => Purifier::clean($request->first_name),
            'lname' => Purifier::clean($request->last_name),
            'name' => Purifier::clean($request->first_name) . ' ' . Purifier::clean($request->last_name),
            'email' => Purifier::clean($request->email),
            'gender' => Purifier::clean($request->gender),
            'dob' => Purifier::clean($request->birthday),
            'qualification' => Purifier::clean($request->degree),
            'mobile' => Purifier::clean($request->mobile),
            'address' => Purifier::clean($request->address),
            'city' => Purifier::clean($request->city),
            'age' => $age,
        ]);
        if ($request->password) {
            $user->update(['password' => Hash::make($request->password),]);
        }
        session()->flash('success', __('Successfully Updated'));

        Toastr::success('success', __('Successfully Updated'), ["positionClass" => "toast-top-right"]);

        return redirect()->route('patient.index');
    }
}
