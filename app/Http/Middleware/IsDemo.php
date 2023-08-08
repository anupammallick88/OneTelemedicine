<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class IsDemo
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
        if (env('APP_DEMO') == false) {
            return $next($request);
        }
        Toastr::info('info', __('This is a demo version! You can get full access after purchasing the application'), ["positionClass" => "toast-top-right"]);
        return redirect()->back()->with('info', __('This is a demo version! You can get full access after purchasing the application.'));
    }
}
