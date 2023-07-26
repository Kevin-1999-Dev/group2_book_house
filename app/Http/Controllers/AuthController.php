<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Laravel\Fortify\Fortify;
use \Illuminate\Contracts\Auth\PasswordBroker;

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

    public function processForgetPassword(Request $request)
    {
        $request->validate([Fortify::email() => 'required|email']);
        $status = Password::broker(config('fortify.passwords'))->sendResetLink(
            $request->only(Fortify::email())
        );
        if (User::where('email', $request['email'])->exists()) {
            if (Password::RESET_LINK_SENT) {
                return redirect()->back()->with('status', "success");
            } else {
                return redirect()->back()->with('status', "failed");
            }
        } else {
            return redirect()->back()->with('status', "not-found");
        }
    }
}
