<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminManager
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
        if (!Auth::check()) {
            return redirect(route('login'));
        } else {
            switch (Auth::user()->user_level) {
                case User::USER_LEVEL['PATIENT']:
                    return redirect(route('PatientManager.patient'));
                    break;
                case User::USER_LEVEL['DOCTOR']:
                    return redirect(route('DoctorManager.doctor'));
                    break;
                default:
                    break;
            }
        }
        return $next($request);
    }
}
