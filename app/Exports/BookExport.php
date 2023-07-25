<?php
namespace App\Exports;
use App\Models\Book;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
class BookExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Book::all();
    }
    /**
     * headings
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Id',
            'Title',
            'Cover',
            'Description',
            'Page Count',
            'Price',
            'Created_at',
            'Updated_at',
        ];
    }
}
