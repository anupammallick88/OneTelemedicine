<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class DoctorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->role == 'patient') {
            return $next($request);
       }
        session()->flash('success', __('Only patient can make appointment'));

        Toastr::success('success', __('Only patient can make appointment'), ["positionClass" => "toast-top-right"]);
        
        return back();
    }
}
