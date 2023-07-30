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

/**
 * DatabaseSeeder
 */
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
            'password' => Hash::make('adminadmin'),
            'role' => true,
        ]);

        User::create([
            'name' => 'user1',
            'email' => 'u1@gmail.com',
            'phone' => '09222222222',
            'address' => 'Knowhere',
            'password' =>  Hash::make('useruser'),
            'role' => false,
        ]);

        User::create([
            'name' => 'user2',
            'email' => 'u2@gmail.com',
            'phone' => '09222222222',
            'address' => 'Knowhere',
            'password' =>  Hash::make('useruser'),
            'role' => false,
        ]);

        Author::create([
            'name' => 'William Shakespeare',
        ]);

        Author::create([
            'name' => 'Stephen King',
        ]);

        Author::create([
            'name' => 'James Patterson',
        ]);

        Author::create([
            'name' => 'J.K Rowling',
        ]);

        Author::create([
            'name' => 'Charles M. Schulz',
        ]);

        Author::create([
            'name' => 'Andrew Gross',
        ]);

        Category::create([
            'name' => 'Drama',
        ]);

        Category::create([
            'name' => 'Fiction',
        ]);

        Category::create([
            'name' => 'Comic',
        ]);

        Category::create([
            'name' => 'Horror',
        ]);

        Category::create([
            'name' => 'Thriller',
        ]);

        Category::create([
            'name' => 'Crime',
        ]);

        Category::create([
            'name' => 'Fantasy',
        ]);

        Payment::create([
            'name' => 'Cash',
        ]);

        Payment::create([
            'name' => 'AYA Bank',
        ]);

        Payment::create([
            'name' => 'CB Bank',
        ]);

        Payment::create([
            'name' => 'KBZ Bank',
        ]);

        Book::create([
            'title' => 'Romeo and Juliet',
            'cover' => 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Romeo_and_Juliet_Q2_Title_Page-2.jpg',
            'description' => 'Written by William Shakespeare early in his career about the romance between two Italian youths from feuding families.',
            'pagecount' => 201,
            'price' => 10000,
        ]);

        Book::create([
            'title' => 'A Midsummer Night\'s Dream',
            'cover' => 'https://thebaronsmen.org/site/assets/files/2101/71e6ouzedwl.250x0.jpg',
            'description' => 'Written by William Shakespeare early in his career about the romance between two Italian youths from feuding families.',
            'pagecount' => 231,
            'price' => 15000,
        ]);

        Book::create([
            'title' => 'Hamlet',
            'cover' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6a/Edwin_Booth_Hamlet_1870.jpg/220px-Edwin_Booth_Hamlet_1870.jpg',
            'description' => 'Prince Hamlet and his attempts to exact revenge against his uncle',
            'pagecount' => 431,
            'price' => 9000,
        ]);

        Book::create([
            'title' => 'IT',
            'cover' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/It_%281986%29_front_cover%2C_first_edition.jpg/220px-It_%281986%29_front_cover%2C_first_edition.jpg',
            'description' => 'It is a 1986 horror novel by American author Stephen King',
            'pagecount' => 323,
            'price' => 10000,
        ]);

        Book::create([
            'title' => 'The Shining',
            'cover' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/The_Shining_%281977%29_front_cover%2C_first_edition.jpg/220px-The_Shining_%281977%29_front_cover%2C_first_edition.jpg',
            'description' => 'The Shining is a 1977 horror novel by American author Stephen King.',
            'pagecount' => 212,
            'price' => 12000,
        ]);

        Book::create([
            'title' => 'Judge & Jury',
            'cover' => 'https://upload.wikimedia.org/wikipedia/en/thumb/7/7c/Judge_and_Jury_by_James_Patterson.jpg/220px-Judge_and_Jury_by_James_Patterson.jpg',
            'description' => 'Judge & Jury is a popular novel written by thriller novel writer James Patterson with Andrew Gross.',
            'pagecount' => 424,
            'price' => 15000,
        ]);

        Book::create([
            'title' => 'Harry Potter and the Philosopher\'s Stone',
            'cover' => 'https://upload.wikimedia.org/wikipedia/en/thumb/6/6b/Harry_Potter_and_the_Philosopher%27s_Stone_Book_Cover.jpg/220px-Harry_Potter_and_the_Philosopher%27s_Stone_Book_Cover.jpg',
            'description' => 'Harry Potter and the Philosopher\'s Stone is a fantasy novel written by British author J. K. Rowling.',
            'pagecount' => 124,
            'price' => 15000,
        ]);

        Book::create([
            'title' => 'Harry Potter and the Prisoner of Azkaban',
            'cover' => 'https://upload.wikimedia.org/wikipedia/en/thumb/a/a0/Harry_Potter_and_the_Prisoner_of_Azkaban.jpg/220px-Harry_Potter_and_the_Prisoner_of_Azkaban.jpg',
            'description' => 'Harry Potter and the Prisoner of Azkaban is a fantasy novel written by British author J. K. Rowling and is the third in the Harry Potter series.',
            'pagecount' => 142,
            'price' => 16000,
        ]);

        Book::create([
            'title' => 'Harry Potter and the Order of the Phoenix',
            'cover' => 'https://upload.wikimedia.org/wikipedia/en/thumb/7/70/Harry_Potter_and_the_Order_of_the_Phoenix.jpg/220px-Harry_Potter_and_the_Order_of_the_Phoenix.jpg',
            'description' => 'Harry Potter and the Order of the Phoenix is a fantasy novel written by British author J. K. Rowling and the fifth novel in the Harry Potter series.',
            'pagecount' => 132,
            'price' => 14000,
        ]);

        Book::create([
            'title' => 'Charles M. Schulz\' Snoopy',
            'cover' => 'https://m.media-amazon.com/images/I/41zQbnX9qjL._SX331_BO1,204,203,200_.jpg',
            'description' => 'Charles Monroe "Sparky" Schulz was an American cartoonist and the creator of the comic strip Peanuts.',
            'pagecount' => 112,
            'price' => 12000,
        ]);

        Book::create([
            'title' => 'Snoopy to the Rescue: A PEANUTS Collection: 8',
            'cover' => 'https://m.media-amazon.com/images/I/514KXbTLHRL._SX331_BO1,204,203,200_.jpg',
            'description' => 'What we need is a hero! In times of struggle an attack of crabbiness, a stolen piano.',
            'pagecount' => 212,
            'price' => 10000,
        ]);

        Book::create([
            'title' => 'Merry Christmas, Charlie Brown!',
            'cover' => 'https://m.media-amazon.com/images/I/61gRnvZFN9L._SY476_BO1,204,203,200_.jpg',
            'description' => 'This Christmas tree-shaped board book with shiny foil on the cover tells a heartwarming Peanuts holiday story.',
            'pagecount' => 85,
            'price' => 11000,
        ]);

        Ebook::create([
            'title' => 'Harry Potter and the Philosopher\'s Stone',
            'cover' => 'https://upload.wikimedia.org/wikipedia/en/thumb/6/6b/Harry_Potter_and_the_Philosopher%27s_Stone_Book_Cover.jpg/220px-Harry_Potter_and_the_Philosopher%27s_Stone_Book_Cover.jpg',
            'description' => 'Harry Potter and the Philosopher\'s Stone is a fantasy novel written by British author J. K. Rowling.',
            'pagecount' => 124,
            'price' => 15000,
            'link' => 'sample.pdf',
        ]);

        Ebook::create([
            'title' => 'Harry Potter and the Prisoner of Azkaban',
            'cover' => 'https://upload.wikimedia.org/wikipedia/en/thumb/a/a0/Harry_Potter_and_the_Prisoner_of_Azkaban.jpg/220px-Harry_Potter_and_the_Prisoner_of_Azkaban.jpg',
            'description' => 'Harry Potter and the Prisoner of Azkaban is a fantasy novel written by British author J. K. Rowling and is the third in the Harry Potter series.',
            'pagecount' => 142,
            'price' => 16000,
            'link' => 'sample.pdf',
        ]);

        Ebook::create([
            'title' => 'Harry Potter and the Order of the Phoenix',
            'cover' => 'https://upload.wikimedia.org/wikipedia/en/thumb/7/70/Harry_Potter_and_the_Order_of_the_Phoenix.jpg/220px-Harry_Potter_and_the_Order_of_the_Phoenix.jpg',
            'description' => 'Harry Potter and the Order of the Phoenix is a fantasy novel written by British author J. K. Rowling and the fifth novel in the Harry Potter series.',
            'pagecount' => 132,
            'price' => 14000,
            'link' => 'sample.pdf',
        ]);

        Ebook::create([
            'title' => 'Charles M. Schulz\' Snoopy',
            'cover' => 'https://m.media-amazon.com/images/I/41zQbnX9qjL._SX331_BO1,204,203,200_.jpg',
            'description' => 'Charles Monroe "Sparky" Schulz was an American cartoonist and the creator of the comic strip Peanuts.',
            'pagecount' => 112,
            'price' => 12000,
            'link' => 'sample.pdf',
        ]);

        Ebook::create([
            'title' => 'Snoopy to the Rescue: A PEANUTS Collection: 8',
            'cover' => 'https://m.media-amazon.com/images/I/514KXbTLHRL._SX331_BO1,204,203,200_.jpg',
            'description' => 'What we need is a hero! In times of struggle an attack of crabbiness, a stolen piano.',
            'pagecount' => 212,
            'price' => 10000,
            'link' => 'sample.pdf',
        ]);

        Ebook::create([
            'title' => 'Merry Christmas, Charlie Brown!',
            'cover' => 'https://m.media-amazon.com/images/I/61gRnvZFN9L._SY476_BO1,204,203,200_.jpg',
            'description' => 'This Christmas tree-shaped board book with shiny foil on the cover tells a heartwarming Peanuts holiday story.',
            'pagecount' => 85,
            'price' => 11000,
            'link' => 'sample.pdf',
        ]);

        Ebook::create([
            'title' => 'Romeo and Juliet',
            'cover' => 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Romeo_and_Juliet_Q2_Title_Page-2.jpg',
            'description' => 'Written by William Shakespeare early in his career about the romance between two Italian youths from feuding families.',
            'pagecount' => 201,
            'link' => 'sample.pdf',
            'price' => 10000,
        ]);

        Ebook::create([
            'title' => 'A Midsummer Night\'s Dream',
            'cover' => 'https://thebaronsmen.org/site/assets/files/2101/71e6ouzedwl.250x0.jpg',
            'description' => 'Written by William Shakespeare early in his career about the romance between two Italian youths from feuding families.',
            'pagecount' => 231,
            'link' => 'sample.pdf',
            'price' => 15000,
        ]);

        Ebook::create([
            'title' => 'Hamlet',
            'cover' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6a/Edwin_Booth_Hamlet_1870.jpg/220px-Edwin_Booth_Hamlet_1870.jpg',
            'description' => 'Prince Hamlet and his attempts to exact revenge against his uncle',
            'pagecount' => 431,
            'link' => 'sample.pdf',
            'price' => 9000,
        ]);

        Ebook::create([
            'title' => 'IT',
            'cover' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/It_%281986%29_front_cover%2C_first_edition.jpg/220px-It_%281986%29_front_cover%2C_first_edition.jpg',
            'description' => 'It is a 1986 horror novel by American author Stephen King',
            'pagecount' => 323,
            'link' => 'sample.pdf',
            'price' => 10000,
        ]);

        Ebook::create([
            'title' => 'The Shining',
            'cover' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/The_Shining_%281977%29_front_cover%2C_first_edition.jpg/220px-The_Shining_%281977%29_front_cover%2C_first_edition.jpg',
            'description' => 'The Shining is a 1977 horror novel by American author Stephen King.',
            'pagecount' => 212,
            'link' => 'sample.pdf',
            'price' => 12000,
        ]);

        Ebook::create([
            'title' => 'Judge & Jury',
            'cover' => 'https://upload.wikimedia.org/wikipedia/en/thumb/7/7c/Judge_and_Jury_by_James_Patterson.jpg/220px-Judge_and_Jury_by_James_Patterson.jpg',
            'description' => 'Judge & Jury is a popular novel written by thriller novel writer James Patterson with Andrew Gross.',
            'pagecount' => 424,
            'link' => 'sample.pdf',
            'price' => 15000,
        ]);

        BookAuthor::create([
            'book_id' => 1,
            'author_id' => 1
        ]);

        BookAuthor::create([
            'book_id' => 2,
            'author_id' => 1
        ]);

        BookAuthor::create([
            'book_id' => 3,
            'author_id' => 1
        ]);

        BookAuthor::create([
            'book_id' => 4,
            'author_id' => 2
        ]);

        BookAuthor::create([
            'book_id' => 5,
            'author_id' => 2
        ]);

        BookAuthor::create([
            'book_id' => 6,
            'author_id' => 3
        ]);

        BookAuthor::create([
            'book_id' => 6,
            'author_id' => 4
        ]);

        BookAuthor::create([
            'book_id' => 7,
            'author_id' => 4
        ]);

        BookAuthor::create([
            'book_id' => 8,
            'author_id' => 4
        ]);

        BookAuthor::create([
            'book_id' => 9,
            'author_id' => 4
        ]);

        BookAuthor::create([
            'book_id' => 10,
            'author_id' => 5
        ]);

        BookAuthor::create([
            'book_id' => 11,
            'author_id' => 5
        ]);

        BookAuthor::create([
            'book_id' => 12,
            'author_id' => 5
        ]);

        EbookAuthor::create([
            'ebook_id' => 1,
            'author_id' => 4
        ]);

        EbookAuthor::create([
            'ebook_id' => 2,
            'author_id' => 4
        ]);

        EbookAuthor::create([
            'ebook_id' => 3,
            'author_id' => 4
        ]);

        EbookAuthor::create([
            'ebook_id' => 4,
            'author_id' => 5
        ]);

        EbookAuthor::create([
            'ebook_id' => 5,
            'author_id' => 5
        ]);

        EbookAuthor::create([
            'ebook_id' => 6,
            'author_id' => 5
        ]);

        EbookAuthor::create([
            'ebook_id' => 7,
            'author_id' => 1
        ]);

        EbookAuthor::create([
            'ebook_id' => 8,
            'author_id' => 1
        ]);

        EbookAuthor::create([
            'ebook_id' => 9,
            'author_id' => 1
        ]);

        EbookAuthor::create([
            'ebook_id' => 10,
            'author_id' => 2
        ]);

        EbookAuthor::create([
            'ebook_id' => 11,
            'author_id' => 2
        ]);

        EbookAuthor::create([
            'ebook_id' => 12,
            'author_id' => 3
        ]);

        EbookAuthor::create([
            'ebook_id' => 12,
            'author_id' => 4
        ]);

        BookCategory::create([
            'book_id' => 1,
            'category_id' => 1
        ]);

        BookCategory::create([
            'book_id' => 2,
            'category_id' => 5
        ]);

        BookCategory::create([
            'book_id' => 2,
            'category_id' => 5
        ]);

        BookCategory::create([
            'book_id' => 3,
            'category_id' => 1
        ]);

        BookCategory::create([
            'book_id' => 4,
            'category_id' => 2
        ]);

        BookCategory::create([
            'book_id' => 4,
            'category_id' => 4
        ]);

        BookCategory::create([
            'book_id' => 4,
            'category_id' => 5
        ]);

        BookCategory::create([
            'book_id' => 5,
            'category_id' => 2
        ]);

        BookCategory::create([
            'book_id' => 5,
            'category_id' => 4
        ]);

        BookCategory::create([
            'book_id' => 5,
            'category_id' => 5
        ]);

        BookCategory::create([
            'book_id' => 6,
            'category_id' => 6
        ]);

        BookCategory::create([
            'book_id' => 7,
            'category_id' => 2
        ]);

        BookCategory::create([
            'book_id' => 7,
            'category_id' => 7
        ]);

        BookCategory::create([
            'book_id' => 8,
            'category_id' => 2
        ]);

        BookCategory::create([
            'book_id' => 8,
            'category_id' => 7
        ]);

        BookCategory::create([
            'book_id' => 9,
            'category_id' => 2
        ]);

        BookCategory::create([
            'book_id' => 9,
            'category_id' => 7
        ]);

        BookCategory::create([
            'book_id' => 10,
            'category_id' => 3
        ]);

        BookCategory::create([
            'book_id' => 11,
            'category_id' => 3
        ]);

        BookCategory::create([
            'book_id' => 12,
            'category_id' => 3
        ]);

        EbookCategory::create([
            'ebook_id' => 1,
            'category_id' => 2
        ]);

        EbookCategory::create([
            'ebook_id' => 1,
            'category_id' => 7
        ]);

        EbookCategory::create([
            'ebook_id' => 2,
            'category_id' => 2
        ]);

        EbookCategory::create([
            'ebook_id' => 2,
            'category_id' => 7
        ]);

        EbookCategory::create([
            'ebook_id' => 3,
            'category_id' => 2
        ]);

        EbookCategory::create([
            'ebook_id' => 3,
            'category_id' => 7
        ]);

        EbookCategory::create([
            'ebook_id' => 4,
            'category_id' => 3
        ]);

        EbookCategory::create([
            'ebook_id' => 5,
            'category_id' => 3
        ]);

        EbookCategory::create([
            'ebook_id' => 6,
            'category_id' => 3
        ]);
        
        EbookCategory::create([
            'ebook_id' => 7,
            'category_id' => 1
        ]);

        EbookCategory::create([
            'ebook_id' => 7,
            'category_id' => 5
        ]);

        EbookCategory::create([
            'ebook_id' => 8,
            'category_id' => 5
        ]);

        EbookCategory::create([
            'ebook_id' => 9,
            'category_id' => 1
        ]);

        EbookCategory::create([
            'ebook_id' => 10,
            'category_id' => 2
        ]);

        EbookCategory::create([
            'ebook_id' => 10,
            'category_id' => 4
        ]);

        EbookCategory::create([
            'ebook_id' => 10,
            'category_id' => 5
        ]);

        EbookCategory::create([
            'ebook_id' => 11,
            'category_id' => 2
        ]);

        EbookCategory::create([
            'ebook_id' => 11,
            'category_id' => 4
        ]);

        EbookCategory::create([
            'ebook_id' => 11,
            'category_id' => 5
        ]);

        EbookCategory::create([
            'ebook_id' => 12,
            'category_id' => 6
        ]);
        Feedback::create([
            'name' => 'Summer',
            'email' => 'summer@nomail.com',
            'address' => 'Summer Avenue ',
            'subject' => 'Do You Deliver?',
            'message' => 'Do you deliver physical books?',
        ]);

        Feedback::create([
            'name' => 'Rick',
            'email' => 'rick@nomail.com',
            'address' => 'Garage Block',
            'subject' => 'Wow',
            'message' => 'Wubba lubba dub dub!',
        ]);

        Feedback::create([
            'name' => 'Jerry',
            'email' => 'jerry@nomail.com',
            'address' => 'Home',
            'subject' => 'Trick',
            'message' => 'The trick to cereal is keeping 70% of it above the milk.',
        ]);

        Order::create([
            'user_id' => 2,
            'payment_id' => 1
        ]);

        BookOrder::create([
            'book_id' => 1,
            'order_id' => 1,
            'quantity' => 1,
        ]);

        BookOrder::create([
            'book_id' => 2,
            'order_id' => 1,
            'quantity' => 1,
        ]);

        BookOrder::create([
            'book_id' => 3,
            'order_id' => 1,
            'quantity' => 1,
        ]);

        EbookOrder::create([
            'ebook_id' => 1,
            'order_id' => 1
        ]);

        Order::create([
            'user_id' => 3,
            'payment_id' => 2
        ]);

        BookOrder::create([
            'book_id' => 4,
            'order_id' => 2,
            'quantity' => 1,
        ]);

        BookOrder::create([
            'book_id' => 5,
            'order_id' => 2,
            'quantity' => 1,
        ]);

        BookOrder::create([
            'book_id' => 6,
            'order_id' => 2,
            'quantity' => 1,
        ]);

        EbookOrder::create([
            'ebook_id' => 3,
            'order_id' => 2
        ]);

        Order::create([
            'user_id' => 3,
            'payment_id' => 3
        ]);

        BookOrder::create([
            'book_id' => 5,
            'order_id' => 3,
            'quantity' => 1,
        ]);

        BookOrder::create([
            'book_id' => 6,
            'order_id' => 3,
            'quantity' => 1,
        ]);

        EbookOrder::create([
            'ebook_id' => 5,
            'order_id' => 3
        ]);
    }
}
