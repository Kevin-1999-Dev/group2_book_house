<?php

namespace App\Dao;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Contracts\Dao\UserDaoInterface;
use Illuminate\Support\Facades\Storage;

class UserDao implements UserDaoInterface
{
    public function password(array $data)
    {
        $id = Auth::user()->id;
        $user = User::select('password')->where('id', $id)->first();
        $dbPassword = $user->password;
        $userOldPassword = $data['oldPassword'];

        if (Hash::check($userOldPassword, $dbPassword)) {
            User::where('id', $id)->update([
                'password' => Hash::make($data['newPassword']),
            ]);
            Auth::logout();
        }
    }

    public function userProfile(ProfileRequest $data,int $id)
    {
        $input = [
            'name'=>$data['name'],
            'email'=>$data['email'],
            'phone'=>$data['phone'],
            'address'=>$data['address'],
        ];
        if($data->hasFile('image')){
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage['image'];

            if($dbImage != null){
                Storage::delete('public/' . $dbImage);
            }

            $getFile = uniqid() . $data->file('image')->getClientOriginalName();
            $data->file('image')->storeAs('public', $getFile);
           $input['image'] = $getFile;
        }
         User::where('id', $id)->update($input);

    }
}
