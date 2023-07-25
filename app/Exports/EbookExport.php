<?php
namespace App\Exports;
use App\Models\Ebook;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
class EbookExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Ebook::all();
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
            'Link',
            'Page Count',
            'Price',
            'Created_at',
            'Updated_at',
        ];
    }
}
