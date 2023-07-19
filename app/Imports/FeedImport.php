<?php

namespace App\Imports;

use App\Models\Feedback;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class FeedImport implements ToModel,WithHeadingRow,WithValidation
{
    /**
    * @param Collection $collection
    */

    public function model(array $row)
    {
        return new Feedback([
            'name'=>$row['name'],
            'email'=>$row['email'],
            'address'=>$row['address'],
            'subject'=>$row['subject'],
            'message'=>$row['message'],
        ]);
    }
    public function rules():array
    {
        return [
            'name' => 'required',
            'email'=>'required',
            'address'=>'required',
            'subject'=>'required',
            'message'=>'required',
        ];
    }
}
