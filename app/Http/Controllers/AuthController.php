<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //direct login Page
    public function login()
    {
        return view('auth.login');
    }
    //direct register Page
    public function register()
    {
        return view('auth.register');
    }
    //Check Role afer Login and Register
    public function checkRole()
    {
        if (Auth::user()->role == 1) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }
    public function forgetPassword()
    {
        return view('auth.forgot-password');
    }
}
