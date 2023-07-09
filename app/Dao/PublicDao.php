<?php

namespace App\Dao;

use App\Contracts\Dao\PublicDaoInterface;
use App\Models\Book;

class PublicDao implements PublicDaoInterface
{

    public function getBooks(): object
    {
        $books = Book::all();
        foreach ($books as $book) {
            $book['date'] = date_format($book->created_at,"m/d/Y");
        }
        return $books;
    }

}
