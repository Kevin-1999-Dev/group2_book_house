<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!empty(Auth::user())) {
            if (
                url()->current() == route('auth.loginPage')
                || url()->current() == route('auth.registerPage')
                || url()->current() == route('auth.forgetPasswordPage')
            ) {
                return back();
            }
            if (Auth::user()->role == 0 ) {
                return back();
            }else{
                if(Auth::user()->active == 1){
                    return $next($request);
                }else{
                    Auth::logout();
                    return back()->with(['not'=>'Your account is disable']);
                }
                return $next($request);
            }
            return $next($request);
        }
        return $next($request);
    }
}
