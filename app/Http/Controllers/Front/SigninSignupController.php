<?php

namespace App\Http\Controllers\Front;

use App\User;
use App\Mail\ForgetPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\DoctorCategory;

class SigninSignupController extends Controller
{
    public function signin()
    {
        return view('front.pages.signin');
    }

    public function signup()
    {
        return view('front.pages.signup');
    }

    public function doctorsignup()
    {
        $category = DoctorCategory::all();
        return view('front.pages.doctor-signup', compact('category'));
    }

    public function forgetpassword()
    {
        return view('front.pages.forget');
    }

    public function forgetpasswordpost(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user) {
            try {
                $token = resetPasswordToken();
                User::whereId($user->id)->update([
                    'reset_password' => $token,
                ]);
                Mail::to($user->email)->send(new ForgetPassword($token));
                return redirect()->back()->with('message', __('Mail Send Successfully!'));
            } catch (\Throwable $th) {
                return redirect()->back()->with('message', __('Mail Server is not Ready!'));
            }

        }
        return redirect()->back()->with('message', __('User Not Found!'));
    }

    public function resetpassword($token)
    {
        return view('front.pages.reset', compact('token'));
    }
    public function resetpasswordpost(Request $request,$token)
    {
        $user = User::where('reset_password', $token)->first();
        if($user){
            if($request->password == null || $request->password != $request->confirm_password) {
                return redirect()->back()->with('error', __('Field Requirement Problem!'));
            }
            $new_pass = Hash::make($request->password);
            User::whereId($user->id)->update([
                'password' => $new_pass,
                'reset_password' => null,
            ]);
            return redirect()->back()->with('message', __('Password Changed!'));
        }
        return redirect()->back()->with('error', __('Token Invalid!'));
    }
}
