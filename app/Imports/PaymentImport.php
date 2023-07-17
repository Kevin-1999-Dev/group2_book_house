<?php

namespace App\Imports;
use App\Models\Payment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PaymentImport implements ToModel,WithHeadingRow,WithValidation
{
    /**
    * @param Collection $collection
    */

    public function model(array $row)
    {
        return new Payment([
            'name'=>$row['name'],
        ]);
    }
    public function rules():array
    {
        return [
            'name' => 'unique:payments,name',
        ];
    }
}
