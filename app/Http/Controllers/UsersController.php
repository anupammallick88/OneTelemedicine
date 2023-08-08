<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Doctor;
use App\Service\UserService;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Http\Requests\AddStoreRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\PatientRequest;
use App\Models\Models\Appointment;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Mews\Purifier\Facades\Purifier;

class UsersController extends Controller
{

    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(UsersDataTable $dataTable)
    {
        $user = User::all();
        return $dataTable->render('users.index', compact('user'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    public function store(AddStoreRequest $request)
    {
        if (!empty($request->thumb_image)) {
            $thumb_image = fileUpload($request['thumb_image'], path_user_image()); // upload file
        } else {
            $thumb_image = null;
        }
        $user = User::create([
            'fname' => Purifier::clean($request->first_name),
            'lname' => Purifier::clean($request->last_name),
            'name' => Purifier::clean($request->first_name) . ' ' . Purifier::clean($request->last_name),
            'email' => Purifier::clean($request->email),
            'gender' => Purifier::clean($request->gender),
            'image' => $thumb_image,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        $user->assignRole($request->input('roles'));
        session()->flash('success', __('Successfully Created'));
        Toastr::success('success', __('Successfully Created'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.user.index');
    }

    public function show(User $user)
    {
        if (request()->wantsJson()) {
            return  $this->userService->show($user->id);
        } else {
            $data['user'] = $user;
            $data['roles'] = Role::pluck('name', 'name')->all();
            $data['userRole'] = $user->roles->pluck('name', 'name')->all();
            return view('users.edit', $data);
        }
    }

    public function update(User $user, Request $request)
    {
        $input = Purifier::clean($request->except('image', 'bio'));

        $input['bio'] = Purifier::clean($request->bio);
        if (!empty($request->image)) {
            $old_img = '';
            $file = User::where('id', $user->id)->first();
            $old_img = isset($file) ? $file->image : '';
            $input['image'] = fileUpload($request['image'], path_user_image(), $old_img); // upload file
        }

        $user->update([
            'fname' => Purifier::clean($request->first_name),
            'lname' => Purifier::clean($request->last_name),
            'name' => Purifier::clean($request->first_name) . ' ' . Purifier::clean($request->last_name),
            'email' => Purifier::clean($request->email),
            'gender' => Purifier::clean($request->gender),
            'role' => 'admin',
        ]);
        $user->syncRoles($request->input('roles'));

        session()->flash('success', __('Successfully Updated'));
        Toastr::success('success', __('Successfully Updated'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.user.index');
    }


    public function delete(User $user)
    {
        if ($user->role == 'admin') {
            $user = $this->userService->delete($user->id);
        } elseif ($user->role == 'patient') {
            Appointment::where('user_id', $user->id)->delete();
            $user = $this->userService->delete($user->id);
        } elseif ($user->role == 'doctor') {
            $doctor = Doctor::where('user_id', $user->id)->first();
            Appointment::where('doctor_id', $doctor->id)->delete();
            DB::table('doctor_doctor_slot')->where('doctor_id', $doctor->id)->delete();
            Doctor::where('user_id', $user->id)->delete();
            $user = $this->userService->delete($user->id);
        }

        if ($user['success'] == true) {
            session()->flash('success', __('Successfully Deleted'));
            Toastr::success('success', __('Successfully Deleted'), ["positionClass" => "toast-top-right"]);
        } else {
            session()->flash('success', __('Not Deleted'));
            Toastr::success('success', __('Not Deleted'), ["positionClass" => "toast-top-right"]);
        }
        return back();
    }
}
