<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'fname' => ['required', 'string', 'max:255'],
                'lname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string'],
                'role' => ['required'],
                'agree' => ['required'],                
                'mobile' => ['required'],                
            ],
            [
                'fname.required' => __('First name field is required'),
                'lname.required' => __('Last name field is required'),                                
                'mobile.required' => __('Mibile field is required'),
                
            ]

        );
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
                'fname.required' => __('First name is required'),
                'lname.required' => __('Last name is required'),
                'password.required' => __('Password is required'),
                'email.required' => __('Email is required'),                
                'mobile.required' => __('Mobile is required'),                
        ];
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // $dob = $data['birthday'];
        // $age = Carbon::parse($dob)->age;

        return User::create([
            'fname' => Purifier::clean($data['fname']),
            'lname' => Purifier::clean($data['lname']),
            'name' => Purifier::clean($data['fname']) . ' ' . Purifier::clean($data['lname']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => Purifier::clean($data['role']),
            'status' => '1',
            'approve' => '1',            
            'mobile' => $data['mobile'],
            
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        if ($user->role == 'patient') {
            return redirect()->route('patient.dashboard');
        } elseif ($user->role == 'admin') {
            return redirect()->route('signin');
        } else {
            return redirect()->route('signin');
        }
    }
}
