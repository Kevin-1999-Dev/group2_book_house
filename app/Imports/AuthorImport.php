<?php

namespace App\Imports;
use App\Models\Author;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AuthorImport implements ToModel,WithHeadingRow,WithValidation
{
    /**
    * @param Collection $collection
    */

    public function model(array $row)
    {
        return new Author([
            'name'=>$row['name'],
        ]);
    }
    public function rules():array
    {
        return [
            'name' => 'unique:authors,name',
        ];
    }
}
