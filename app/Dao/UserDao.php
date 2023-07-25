<?php

namespace App\Dao;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use App\Contracts\Dao\UserDaoInterface;
use Illuminate\Support\Facades\Storage;

/**
 * UserDao
 */
class UserDao implements UserDaoInterface
{
    /**
     * userProfile
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function userProfile(ProfileRequest $data, int $id)
    {
        $input = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ];
        if ($data->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage['image'];

            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }

            $getFile = uniqid() . $data->file('image')->getClientOriginalName();
            $data->file('image')->storeAs('public', $getFile);
            $input['image'] = $getFile;
        }
        User::where('id', $id)->update($input);
    }
    /**
     * deleteAcc
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteAcc(int $id)
    {
        User::where('id', $id)->delete();
        Auth::logout();
    }
}
