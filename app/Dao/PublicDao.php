<?php
namespace App\Dao;
use App\Models\Book;
use App\Models\Ebook;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Dao\PublicDaoInterface;

class PublicDao implements PublicDaoInterface
{
    /**
     * getAll
     *
     * @return object
     */
    public function getAll(): object
    {
        $books = Book::take(6)->get();
        $ebooks = Ebook::take(6)->get();

        return (object) [
            'books' => $books,
            'ebooks' => $ebooks,
        ];
    }
    /**
     * getBooks
     *
     * @return object
     */
    public function getBooks(): object
    {
        $books = Book::all();
        return $books;
    }
    /**
     * getEbooks
     *
     * @return object
     */
    public function getEbooks(): object
    {
        $ebooks = Ebook::all();
        return $ebooks;
    }
    /**
     * getBookById
     *
     * @param  mixed $id
     * @return object
     */
    public function getBookById($id): object
    {
        $book = Book::findOrFail($id);
        $book['date'] = date_format($book->created_at, "M-d-Y");

        return $book;
    }
    /**
     * getEbookById
     *
     * @param  mixed $id
     * @return object
     */
    public function getEbookById($id): object
    {
        $ebook = Ebook::findOrFail($id);
        $ebook['date'] = date_format($ebook->created_at, "M-d-Y");

        return $ebook;
    }
    /**
     * createFeedback
     *
     * @param  mixed $data
     * @return void
     */
    public function createFeedback(array $data): void
    {
        if(empty(Auth::user())){
            Feedback::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'address' => $data['address'],
                'subject' => $data['subject'],
                'message' => $data['message'],
            ]);
        }else{
            Feedback::create([
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'address' => Auth::user()->address,
                'subject' => $data['subject'],
                'message' => $data['message'],
            ]);
        }
    }
}
