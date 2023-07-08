<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminDash(){
        return view('admin.layouts.master');
    }
}
