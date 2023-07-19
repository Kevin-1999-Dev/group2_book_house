<?php

namespace App\Dao;

use App\Contracts\Dao\PublicDaoInterface;
use App\Models\Book;
use App\Models\Ebook;
use App\Models\Feedback;

class PublicDao implements PublicDaoInterface
{
    public function getAll(): object
    {
        $books = Book::take(4)->get();
        $ebooks = Ebook::take(4)->get();

        return (object) [
            'books' => $books,
            'ebooks' => $ebooks,
        ];
    }

    public function getBooks(): object
    {
        $books = Book::all();
        return $books;
    }

    public function getEbooks(): object
    {
        $ebooks = Ebook::all();
        return $ebooks;
    }

    public function getBookById($id): object
    {
        $book = Book::findOrFail($id);
        $book['date'] = date_format($book->created_at, "M-d-Y");

        return $book;
    }

    public function getEbookById($id): object
    {
        $ebook = Ebook::findOrFail($id);
        $ebook['date'] = date_format($ebook->created_at, "M-d-Y");

        return $ebook;
    }

    public function createFeedback(array $data): void
    {
        Feedback::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'subject' => $data['subject'],
            'message' => $data['message'],
        ]);
    }
}
