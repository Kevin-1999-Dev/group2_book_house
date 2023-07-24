<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //direct login Page
    /**
     * login
     *
     * @return void
     */
    public function login()
    {
        return view('auth.login');
    }
    //direct register Page
    /**
     * register
     *
     * @return void
     */
    public function register()
    {
        return view('auth.register');
    }
    //Check Role afer Login and Register
    /**
     * checkRole
     *
     * @return void
     */
    public function checkRole()
    {
        if (Auth::user()->role == 1) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }
    /**
     * forgetPassword
     *
     * @return void
     */
    public function forgetPassword()
    {
        return view('auth.forgot-password');
    }
}
