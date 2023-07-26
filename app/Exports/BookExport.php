<?php
namespace App\Exports;
use App\Models\Book;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
class BookExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Book::all();
    }
    public function map($book): array
    {
        $author="";
        foreach($book->author as $key => $a){
            $author = $author.','.  $a->name;
        }
        $category = "";
        foreach($book->category as $key => $b){
            $category = $category.','.  $b->name;
        }

        return [
            $book->id,
            $book->title,
            $book->cover,
            $book->description,
            $book->pagecount,
            $book->price,
            $author,
            $category,
            $book->created_at,
            $book->updated_at,
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
