<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Mews\Purifier\Facades\Purifier;

class AdminProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('admin.profile.index', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if($request->password){
            $request->validate([
                'name' => 'required',
                'email'=>[
                    'required',
                    Rule::unique('users')->ignore($user->id),
                ],
                'password' => [
                    'string',
                    'min:8',
                    'confirmed',
                ],
            ]);
        }else{
            $request->validate([
                'name' => 'required',
                'email'=>[
                    'required',
                    Rule::unique('users')->ignore($user->id),
                ],
            ]);
        }
        if($request->password){
            $user->update([
                'name'=> Purifier::clean($request->name),
                'email' => Purifier::clean($request->email),
                'password' => Hash::make($request->password),
            ]);
        }else{
            $user->update([
                'name'=> Purifier::clean($request->name),
                'email' => Purifier::clean($request->email),
            ]);
        }

        $input = [];
        if (!empty($request->image)) {
            if(!empty($user->image)){
                $old_img = '';
                $file = User::where('id', $user->id)->first();
                $old_img = isset($file) ? $file->image : '';
                $input['image'] = fileUpload($request['image'], path_user_image(), $old_img); // upload file
            }else{
                $input['image'] = fileUpload($request['image'], path_user_image()); // upload file
            }
            $user->update($input);
        }

        session()->flash('success', __('Successfully Updated'));

        Toastr::success('success', __('Successfully Updated'), ["positionClass" => "toast-top-right"]);

        return back();
    }
}
