<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    //protected $redirectTo = 'admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // custom logout function
    // redirect to login page
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('admin/login');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    // protected function authenticated(Request $request, $user)
    // {
    //     if ($user->role == 'patient') {
    //         return redirect()->route('patient.dashboard');
    //     } elseif ($user->role == 'admin') {
    //         return redirect()->route('dashboard');
    //     } elseif($user->role == 'stuff') {
    //         return redirect()->route('stuff.dashboard');
    //     } else {
    //         return redirect()->route('doctor.dashboard');
    //     }
    // }

    public function authenticated(Request $request, $user)
    {
        $rules = [
            'email'     => 'required|email|max:255',
            'password'  => 'required',
            'remember'  => 'nullable',
        ];

        $messages = [
            'email.required'        => __('auth.form.validation.email.required'),
            'email.email'           => __('auth.form.validation.email.email'),
            'email.exists'          => __('auth.form.validation.email.exists'),
            'password.required'     => __('auth.form.validation.email.required'),
            'password.exists'       => __('auth.form.validation.email.required'),
        ];

        $data = $this->validate($request, $rules, $messages);

        if (!isset(request()->remember)) {
            $data['remember'] = "off";
        }

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $request->get('remember'))) {
            if (Auth::user()->status == 1 && Auth::user()->approve == 1) {
                session()->flash('success', __('Welcome'));                              
                Toastr::success('success', __('Welcome'), ["positionClass" => "toast-top-right"]);
                    if ($user->role == 'patient') {
                            return redirect()->route('patient.dashboard');
                        } elseif ($user->role == 'admin') {
                            return redirect()->route('dashboard');
                        } elseif($user->role == 'stuff') {
                            return redirect()->route('stuff.dashboard');
                        } else {
                            return redirect()->route('doctor.dashboard');
                        }
            }else if(Auth::user()->status == 0){
                $this->guard()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                session()->flash('error', __('Your account is Deactivated by Admin!'));
                Toastr::success('error', __('Your account is Deactivated by Admin!'), ["positionClass" => "toast-top-right"]);                
                return redirect()->back();

            }else if(Auth::user()->approve == 0){
                $this->guard()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                session()->flash('error', __('Your account is Wating for approval!'));
                Toastr::success('error', __('Your account is Wating for approval!'), ["positionClass" => "toast-top-right"]);                
                return redirect()->back();

            }else{
                $this->guard()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                session()->flash('error', __('Your account is under processing, contact to Admin!'));
                Toastr::success('error', __('Your account is under processing, contact to Admin!'), ["positionClass" => "toast-top-right"]);                
                return redirect()->back();
            }
        }else{
            session()->flash('error', __('These credentials do not match our records!'));
            Toastr::success('error', __('These credentials do not match our records!'), ["positionClass" => "toast-top-right"]);            
            return redirect()->back();
        }
    }
}
