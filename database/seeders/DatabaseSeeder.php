<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\BookCategory;
use App\Models\BookOrder;
use App\Models\Category;
use App\Models\Ebook;
use App\Models\EbookAuthor;
use App\Models\EbookCategory;
use App\Models\EbookOrder;
use App\Models\Feedback;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserEbook;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '09111111111',
            'address' => 'Knowhere',
            'password' => Hash::make('admin'),
            'role' => true,
        ]);

        User::create([
            'name' => 'user1',
            'email' => 'u1@gmail.com',
            'phone' => '09222222222',
            'address' => 'Knowhere',
            'password' =>  Hash::make('user'),
            'role' => false,
        ]);

        Author::create([
            'name' => 'William Shakespeare',
        ]);

        Category::create([
            'name' => 'Drama',
        ]);

        Payment::create([
            'name' => 'Cash',
        ]);

        Order::create([
            'user_id' => 1,
            'comment' => 'Will pickup at 4pm.',
            'payment_id' => 1
        ]);

        Book::create([
            'title' => 'Romeo and Juliet',
            'cover' => 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Romeo_and_Juliet_Q2_Title_Page-2.jpg',
            'description' => 'Written by William Shakespeare early in his career about the romance between two Italian youths from feuding families.',
            'pagecount' => 201,
            'price' => 10000,
        ]);

        Book::create([
            'title' => 'Romeo and Juliet2',
            'cover' => 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Romeo_and_Juliet_Q2_Title_Page-2.jpg',
            'description' => 'Written by William Shakespeare early in his career about the romance between two Italian youths from feuding families.',
            'pagecount' => 201,
            'price' => 10000,
        ]);

        Ebook::create([
            'title' => 'Hamlet',
            'cover' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6a/Edwin_Booth_Hamlet_1870.jpg/220px-Edwin_Booth_Hamlet_1870.jpg',
            'description' => 'Prince Hamlet and his attempts to exact revenge against his uncle',
            'pagecount' => 201,
            'price' => 10000,
            'link' => 'https://en.wikipedia.org/wiki/Hamlet',
        ]);

        BookAuthor::create([
            'book_id' => 1,
            'author_id' => 1
        ]);

        EbookAuthor::create([
            'ebook_id' => 1,
            'author_id' => 1
        ]);

        BookCategory::create([
            'book_id' => 1,
            'category_id' => 1
        ]);

        EbookCategory::create([
            'ebook_id' => 1,
            'category_id' => 1
        ]);

        UserEbook::create([
            'user_id' => 2,
            'ebook_id' => 1,
        ]);

        BookOrder::create([
            'book_id' => 1,
            'order_id' => 1,
            'quantity' => 3,
        ]);

        EbookOrder::create([
            'ebook_id' => 1,
            'order_id' => 1
        ]);

        Feedback::create([
            'name' => 'Summer',
            'email' => 'summer@gmail.com',
            'address' => 'Summer Avenue ',
            'subject' => 'Whatcha doin?',
            'message' => 'What are you doing?',
        ]);
    }
}
