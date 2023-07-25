<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CategoryImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        return new Category([
            'name' => $row['name'],
        ]);
    }
    /**
     * rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'unique:categories,name',
        ];
    }
}
