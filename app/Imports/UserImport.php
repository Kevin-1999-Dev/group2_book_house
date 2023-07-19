<?php

namespace App\Imports;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UserImport implements ToModel,WithHeadingRow,WithValidation
{
    /**
    * @param Collection $collection
    */

    public function model(array $row)
    {

        return new User([
            'name'=>$row['name'],
            'email'=>$row['email'],
            'phone'=>$row['phone'],
            'address'=>$row['address'],
            'password'=>Hash::make($row['password']),
        ]);
    }
    public function rules():array
    {
        return [
            'name' => 'required',
            'email'=>'required|unique:users,email',
            'phone' => 'required|min:10',
            'address' => 'required',
            'password' => 'required',
        ];
    }
}