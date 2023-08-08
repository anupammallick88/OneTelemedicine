<?php

namespace App\Http\Controllers\Doctor;

use App\User;
use App\Models\Doctor;
use App\Models\DoctorSlot;
use Illuminate\Http\Request;
use ParagonIE\Sodium\Compat;
use App\Models\DoctorCategory;
use Mews\Purifier\Facades\Purifier;
use App\DataTables\DoctorsDatatable;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateDoctorRequest;
use App\Http\Requests\DoctorScheduleRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Carbon\Carbon;

class DoctorsController extends Controller
{
    public function index(DoctorsDatatable $dataTable)
    {
        $user = User::where('role', 'doctor')->get();
        return $dataTable->render('admin.doctor.index', compact('user'));
    }
    
    public function create()
    {
        $category = DoctorCategory::all();
        return view('admin.doctor.create', compact('category'));
    }

    public function show(User $user)
    {
        $category = DoctorCategory::all();
        return view('admin.doctor.edit', compact('user', 'category'));
    }

    public function store(CreateDoctorRequest $request)
    {
        try {
            if ($request->off_day != null) {
                $offday = implode(',', Purifier::clean($request->off_day));
            }

            if (!empty($request->file_one)) {
                $file_one = fileUpload($request['file_one'], path_user_image()); // upload file
            } else {
                $file_one = null;
            }
            if (!empty($request->file_two)) {
                $file_two = fileUpload($request['file_two'], path_user_image()); // upload file
            } else {
                $file_two = null;
            } 
            if (!empty($request->file_three)) {
                $file_three = fileUpload($request['file_three'], path_user_image()); // upload file
            } else {
                $file_three = null;
            }
            if (!empty($request->thumb_image)) {
                $thumb_image = fileUpload($request['thumb_image'], path_user_image()); // upload file
            } else {
                $thumb_image = null;
            }

            $user = User::create([
                'name' => Purifier::clean($request->name),
                'email' => Purifier::clean($request->email),
                'gender' => Purifier::clean($request->gender),
                'image' => $thumb_image,
                'password' => Hash::make($request->password),
                'role' => 'doctor',
                'dob' => $request->birthday,
                'qualification' => $request->degree,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'city' => $request->city,
                'file_one' => $file_one,
                'file_two' => $file_two,
                'file_three' => $file_three,
            ]);

            $doctor = Doctor::create([
                'user_id' => $user->id,
                'gender' => Purifier::clean($request->gender),
                'category_id' => $request->docat,
                'fees' => $request->fees,
                'birthday' => $request->birthday,
                'degree' => $request->degree,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'city' => $request->city,                
                'profile_image' => $profile_image,
                'thumb_image' => $thumb_image,                
                'offday' => isset($offday) ? $offday : '',
            ]);

            // $slots = DoctorSlot::get();

            // foreach ($slots as $slot) {
            //     $doctor->slot()->syncWithoutDetaching($slot->id);
            // }

            session()->flash('success', __('Successfully Created'));
            Toastr::success('success', __('Successfully Created'), ["positionClass" => "toast-top-right"]);
            return redirect()->route('doctor.index');
        } catch (Exception $e) {
            session()->flash('error', __('Something went wrong'));
            return redirect()->route('doctor.index');
        }
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed'
        ]);

        if ($request->off_day != null) {
            $offday = implode(',', Purifier::clean($request->off_day));
        }

        $user = User::find($user->id);
        $doctor = Doctor::where('user_id', $user->id)->first();
        if (!empty($request->profile_image)) {
            $profile_image = fileUpload($request['profile_image'], path_user_image()); // upload file
            $doctor->update([
                'profile_image' => $profile_image,
            ]);
        }

        if (!empty($request->thumb_image)) {
            $thumb_image = fileUpload($request['thumb_image'], path_user_image()); // upload file
            $doctor->update([
                'thumb_image' => $thumb_image,
            ]);
            $user->update([
                'image' => $thumb_image,
            ]);
        }

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $dob = $request->birthday;
        $age = Carbon::parse($dob)->age;

        $user->update([
            'name' => Purifier::clean($request->name),
            'email' => Purifier::clean($request->email),
            'gender' => Purifier::clean($request->gender),
            'role' => 'doctor',
            'dob' => $request->birthday,
            'age' => $age,
            'qualification' => $request->degree,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'city' => $request->city,
            'file_one' => $file_one,
            'file_two' => $file_two,
            'file_three' => $file_three,
            
        ]);

        $doctor->update([
            'user_id' => $user->id,
            'gender' => Purifier::clean($request->gender),
            'gender' => Purifier::clean($request->gender),
            'birthday' => $request->birthday,
            'address' => $request->address,
            'city' => $request->city,
            'degree' => $request->degree,
            'category_id' => $request->docat,
            'fees' => $request->fees,
            'offday' => isset($offday) ? $offday : '',
        ]);

        session()->flash('success', __('Successfully Updated'));
        Toastr::success('success', __('Successfully Updated'), ["positionClass" => "toast-top-right"]);

        return redirect()->route('doctor.index');
    }

    public function status_update(User $user)
	{
		$oldstatus = User::find($user->id);
        $oldstatusone = Doctor::where('user_id', $user->id)->first();
        $newstatus = $oldstatus['status'];
        $newstatusone = $oldstatusone['status'];

		if($newstatus == 1 && $newstatusone == 1)
        {
            $updateuser = User::find($user->id)->update(['status' => '0']);
            $newstatusone = Doctor::where('user_id', $user->id)->update(['status' => '0']);
            session()->flash('success', __('Status deactivated successfully.'));
            Toastr::success('success', __('Status deactivated successfully.'), ["positionClass" => "toast-top-right"]);
            return redirect()->route('doctor.index');
        }
        else{
            $updateuser = User::find($user->id)->update(['status' => '1']);
            $newstatusone = Doctor::where('user_id', $user->id)->update(['status' => '1']);
            session()->flash('success', __('Status activated successfully.'));
            Toastr::success('success', __('Status activated successfully.'), ["positionClass" => "toast-top-right"]);
            return redirect()->route('doctor.index');
        }  
	}

	public function approve_update(User $user)
	{
        $oldapprove = User::find($user->id);
        $oldapproveone = Doctor::where('user_id', $user->id)->first();
        $newapprove = $oldapprove['approve'];
        $newapproveone = $oldapproveone['approve'];
		// $user = User::find($request->id)->update(['approve' => $request->approve]);

		if($newapprove == 1 && $newapproveone == 1)
        {
            $updateuser = User::find($user->id)->update(['approve' => '0']);
            $newapproveone = Doctor::where('user_id', $user->id)->update(['approve' => '0']);
            session()->flash('success', __('Approvel deactivated successfully.'));
            Toastr::success('success', __('Approvel deactivated successfully.'), ["positionClass" => "toast-top-right"]);
            return redirect()->route('doctor.index');
        }
        else{
            $updateuser = User::find($user->id)->update(['approve' => '1']);
            $newapproveone = Doctor::where('user_id', $user->id)->update(['approve' => '1']);
            session()->flash('success', __('Approvel activated successfully.'));
            Toastr::success('success', __('Approvel activated successfully.'), ["positionClass" => "toast-top-right"]);
            return redirect()->route('doctor.index');
        }  
	}
}
