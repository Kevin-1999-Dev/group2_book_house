<?php

namespace App\Dao;

use App\Contracts\Dao\PublicDaoInterface;
use App\Models\Book;
use App\Models\Ebook;

class PublicDao implements PublicDaoInterface
{
    public function getAll(): object
    {
        $books = Book::all();
        return $books;

        $ebooks = Ebook::all();
        return $ebooks;
    }

    public function getBooks(): object
    {
        $books = Book::all();
        foreach ($books as $book) {
            $book['date'] = date_format($book->created_at,"m/d/Y");
        }
        return $books;
    }

    public function getEbooks(): object
    {
        $ebooks = Ebook::all();
        foreach ($ebooks as $ebook) {
            $ebook['date'] = date_format($ebook->created_at,"m/d/Y");
        }
        return $ebooks;
    }

}
