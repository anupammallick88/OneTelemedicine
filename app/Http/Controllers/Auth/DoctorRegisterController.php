<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Models\Doctor;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use Exception;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\DoctorCategory;

class DoctorRegisterController extends Controller
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
    // protected function validator(array $data)
    // {
    //     return Validator::make(
    //         $data,
    //         [
    //             'fname' => ['required', 'string', 'max:255'],
    //             'lname' => ['required', 'string', 'max:255'],
    //             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //             'password' => ['required', 'string', 'min:6'],
    //             'role' => ['required'],
    //             'gender' => ['required'],
    //             'birthday' => ['required'],
    //             'degree' => ['required'],
    //             'mobile' => ['required'],
    //             'address' => ['required'],
    //             'city' => ['required'],
    //             'agree' => ['required'],
    //             'file_one' => ['required'],
    //             'file_two' => ['required'],
    //             'file_three' => ['required'],
    //         ],
    //         [
    //             'fname.required' => __('First name field is required'),
    //             'lname.required' => __('Last name field is required'),
    //             'email.required' => __('Email field is required'),
    //             'password.required' => __('Password field is required'),
    //             'gender.required' => __('Gender field is required'),
    //             'birthday.required' => __('birthday field is required'),
    //             'degree.required' => __('Qualification field is required'),
    //             'mobile.required' => __('Mibile field is required'),
    //             'address.required' => __('Address field is required'),
    //             'city.required' => __('City field is required'),
    //             'file_one.required' => __('File field is required'),
    //             'file_two.required' => __('File field is required'),
    //             'file_three.required' => __('File field is required'),
    //         ]

    //     );
    // }


    // /**
    //  * Get the error messages for the defined validation rules.
    //  *
    //  * @return array
    //  */
    // public function messages()
    // {
    //     return [
    //         'fname.required' => __('First name is required'),
    //         'lname.required' => __('Last name is required'),
    //         'password.required' => __('Password is required'),
    //         'email.required' => __('Email is required'),
    //         'gender.required' => __('Gender is required'),
    //         'birthday.required' => __('Birthday is required'),
    //         'degree.required' => __('Qualification is required'),
    //         'mobile.required' => __('Mobile is required'),
    //         'address.required' => __('Address is required'),
    //         'city.required' => __('City is required'),
    //         'file_one.required' => __('File is required'),
    //         'file_two.required' => __('File is required'),
    //         'file_three.required' => __('File is required'),
    //     ];
    // }

    // /**
    //  * Create a new user instance after a valid registration.
    //  *
    //  * @param  array  $data
    //  * @return \App\User
    //  */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'fname' => Purifier::clean($data['fname']),
    //         'lname' => Purifier::clean($data['lname']),
    //         'name' => Purifier::clean($data['fname']) . ' ' . Purifier::clean($data['lname']),
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'role' => Purifier::clean($data['role']),
    //         'gender' => $data['gender'],
    //         'dob' => $data['birthday'],
    //         'qualification' => $data['degree'],
    //         'mobile' => $data['mobile'],
    //         'address' => $data['address'],
    //         'city' => $data['city'],
    //     ]);
    // }

    // /**
    //  * The user has been registered.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  mixed  $user
    //  * @return mixed
    //  */
    // protected function registered(Request $request, $user)
    // {
    //     if ($user->role == 'patient') {
    //         return redirect()->route('signin');
    //     } elseif ($user->role == 'admin') {
    //         return redirect()->route('signin');
    //     } else {
    //         return redirect()->route('signin');
    //     }
    // }


    public function register(Request $request)
	{
        $rules = [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'role' => ['required'],
            'gender' => ['required'],
            'birthday' => ['required'],
            'degree' => ['required'],
            'mobile' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'agree' => ['required'],
            'file_one' => ['required'],
            'file_two' => ['required'],
            'file_three' => ['required'],
        ];

        $messages = [
            'fname.required' => __('First name is required'),
            'lname.required' => __('Last name is required'),
            'password.required' => __('Password is required'),
            'email.required' => __('Email is required'),
            'gender.required' => __('Gender is required'),
            'birthday.required' => __('Birthday is required'),
            'degree.required' => __('Qualification is required'),
            'mobile.required' => __('Mobile is required'),
            'address.required' => __('Address is required'),
            'city.required' => __('City is required'),
            'file_one.required' => __('File is required'),
            'file_two.required' => __('File is required'),
            'file_three.required' => __('File is required'),
        ];

        $this->validate($request, $rules, $messages);

        try {
            if ($request->off_day != null) {
                $offday = implode(',', Purifier::clean($request->off_day));
            }
            if ($request->hasfile("file_one")) {
                $file_one = uniqid(11) . '.' . $request->file('file_one')->getClientOriginalExtension();
                $request->file('file_one')->move(public_path('doctor/doc'), $file_one);
                var_dump($file_one); // upload file
            } else {
                $file_one = null;
            }
            if ($request->hasfile("file_two")) {
                $file_two = uniqid(11) . '.' . $request->file('file_two')->getClientOriginalExtension();
                $request->file('file_two')->move(public_path('doctor/doc'), $file_two);
                var_dump($file_two); // upload file
            } else {
                $file_two = null;
            } 
            if ($request->hasfile("file_three")) {
                $file_three = uniqid(11) . '.' . $request->file('file_three')->getClientOriginalExtension();
                $request->file('file_three')->move(public_path('doctor/doc'), $file_three);
                var_dump($file_three); // upload file
            } else {
                $file_three = null;
            }

            $dob = $request->birthday;
            $age = Carbon::parse($dob)->age;

            $doctorcategory = DoctorCategory::where('id', $request->docat)->first();

            $user = User::create([
                'fname' => Purifier::clean($request->fname),
                'lname' => Purifier::clean($request->lname),
                'name' => Purifier::clean($request->fname) . ' ' . Purifier::clean($request->lname),
                'email' => Purifier::clean($request->email),
                'gender' => Purifier::clean($request->gender),                
                'password' => Hash::make($request->password),
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

            $doctor = Doctor::create([
                'user_id' => $user['id'],
                'gender' => Purifier::clean($request->gender),
                'birthday' => $request->birthday,
                'address' => $request->address,
                'city' => $request->city,
                'degree' => $request->degree,
                'category_id' => $request->docat,
                'specialist' => $doctorcategory->name,
                'fees' => $request->fees,
                'offday' => isset($offday) ? $offday : '',
            ]);

            
            Toastr::success('success', __('Successfully Created'), ["positionClass" => "toast-top-right"]);
            return redirect()->route('signin');
        } catch (Exception $e) {
            Toastr::success('error', __('Something went wrong'), ["positionClass" => "toast-top-right"]);
            return redirect()->route('doctor.signup');
        }
    }
}
