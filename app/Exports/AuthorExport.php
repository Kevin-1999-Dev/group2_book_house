<?php

namespace App\Exports;
use App\Models\Author;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AuthorExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Author::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Name',
        ];
    }
}
