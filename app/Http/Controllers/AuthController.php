<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //direct Home Page
    public function home(){
        return view('layouts.master');
    }
    //direct login Page
    public function login(){
        return view('auth.login');
    }
    //direct register Page
    public function register(){
        return view('auth.register');
    }
    //Check Role afer Login and Register
    public function checkRole(){
        if(Auth::user()->role == 1){
            return redirect()->route('admin.testAdmin');
        }
        return redirect()->route('user.testUser');
    }

    public function testAdmin(){
        return view('admin.test');
    }
    public function testUser(){
        return view('user.test');
    }
}
