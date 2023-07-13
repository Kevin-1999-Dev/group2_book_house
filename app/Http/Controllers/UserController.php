<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Contracts\Services\UserServiceInterface;

class UserController extends Controller
{
    public function userDash(){
        return view('user.dashboard');
    }
    public function changePasswordPage()
    {
        return view('user.profile.change');
    }
    public function profilePage(){
        return view('user.profile.details');
    }
    public function editPage(){
        return view('user.profile.edit');
    }
    private $userService;

    public function __construct(UserServiceInterface $userServiceInterface)
    {
        $this->userService = $userServiceInterface;
    }
    public function changePassword(PasswordRequest $r)
    {
        $this->userService->password($r->only([
            'oldPassword',
            'newPassword',
            'confirmPassword',
        ]));
         return redirect()->route('auth.loginPage')->with(['successPwChange'=>'Successfully Change Password...']);
    }
    public function updateUser(ProfileRequest $request,int $id){
        $this->userService->userProfile($request,$id);
        return redirect()->route('user.details');
    }

}
