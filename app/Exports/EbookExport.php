<?php
namespace App\Exports;
use App\Models\Ebook;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class EBookExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Ebook::all();
    }
    public function map($ebook): array
    {
        $author="";
        foreach($ebook->author as $key => $a){
            $author = $author.','.  $a->name;
        }
        $category = "";
        foreach($ebook->category as $key => $b){
            $category = $category.','.  $b->name;
        }

        return [
            $ebook->id,
            $ebook->title,
            $ebook->cover,
            $ebook->description,
            $ebook->pagecount,
            $ebook->price,
            $ebook->link,
            $author,
            $category,
            $ebook->created_at,
            $ebook->updated_at,
        ];
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
            'Author',
            'Category',
            'Created_at',
            'Updated_at'
        ];
    }
}
