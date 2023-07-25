<?php

namespace App\Dao;

use App\Models\Book;
use App\Models\User;
use App\Models\Ebook;
use App\Models\Order;
use App\Models\Author;
use App\Models\Category;
use App\Models\BookAuthor;
use App\Models\EbookAuthor;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use App\Models\EbookCategory;
use App\Http\Requests\BookRequest;
use App\Http\Requests\EbookRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Storage;
use App\Contracts\Dao\AdminDaoInterface;
use App\Models\Feedback;
use App\Models\Payment;
use App\Models\UserEbook;

class AdminDao implements AdminDaoInterface
{
    /**
     * adminProfile
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function adminProfile(ProfileRequest $data, int $id)
    {
        $input = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ];
        if ($data->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage['image'];
            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }
            $getFile = uniqid() . $data->file('image')->getClientOriginalName();
            $data->file('image')->storeAs('public', $getFile);
            $input['image'] = $getFile;
        }
        User::where('id', $id)->update($input);
    }

    /**
     * getCategories
     *
     * @param  mixed $r
     * @return void
     */
    public function getCategories(Request $r)
    {
        $s = strtolower($r->get('s'));
        if ($r->route()->named('admin.category.index')) {
            return Category::Where('name', 'LIKE', "%$s%")->paginate(config('app.pagination'))->withQueryString();
        }
        return Category::Where('name', 'LIKE', "%$s%")->get();
    }

    /**
     * createCategory
     *
     * @param  mixed $data
     * @return void
     */
    public function createCategory(array $data)
    {
        Category::create([
            'name' => $data['name'],
        ]);
    }

    /**
     * getCategoryById
     *
     * @param  mixed $id
     * @return void
     */
    public function getCategoryById(int $id)
    {
        return Category::findOrFail($id);
    }

    /**
     * updateCategory
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateCategory(array $data, int $id)
    {
        Category::findOrFail($id)->update([
            'name' => $data['name'],
        ]);
    }

    /**
     * deleteCategoryById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteCategoryById(int $id)
    {
        $category = Category::findOrFail($id);
        $category->book->each(function ($i) {
            $i->delete();
        });
        $category->ebook->each(function ($i) {
            $i->delete();
        });
        $category->delete();
    }

    /**
     * getAuthors
     *
     * @param  mixed $r
     * @return void
     */
    public function getAuthors(Request $r)
    {
        $s = strtolower($r->get('s'));
        if ($r->route()->named('admin.author.index')) {
            return Author::Where('name', 'LIKE', "%$s%")->paginate(config('app.pagination'))->withQueryString();
        }
        return Author::Where('name', 'LIKE', "%$s%")->get();
    }

    /**
     * createAuthor
     *
     * @param  mixed $data
     * @return void
     */
    public function createAuthor(array $data)
    {
        Author::create([
            'name' => $data['name'],
        ]);
    }

    /**
     * getAuthorById
     *
     * @param  mixed $id
     * @return void
     */
    public function getAuthorById(int $id)
    {
        return Author::findOrFail($id);
    }

    /**
     * updateAuthor
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateAuthor(array $data, int $id)
    {
        Author::findOrFail($id)->update([
            'name' => $data['name'],
        ]);
    }

    /**
     * deleteAuthorById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteAuthorById(int $id)
    {
        $author = Author::findOrFail($id);
        $author->book->each(function ($i) {
            $i->delete();
        });
        $author->ebook->each(function ($i) {
            $i->delete();
        });
        $author->delete();
    }

    /**
     * getPayments
     *
     * @param  mixed $r
     * @return void
     */
    public function getPayments(Request $r)
    {
        $s = strtolower($r->get('s'));
        if ($r->route()->named('admin.payment.index')) {
            return Payment::Where('name', 'LIKE', "%$s%")->paginate(config('app.pagination'))->withQueryString();
        }
        return Payment::Where('name', 'LIKE', "%$s%")->get();
    }

    /**
     * createPayment
     *
     * @param  mixed $data
     * @return void
     */
    public function createPayment(array $data)
    {
        Payment::create([
            'name' => $data['name'],
        ]);
    }

    /**
     * getPaymentById
     *
     * @param  mixed $id
     * @return void
     */
    public function getPaymentById(int $id)
    {
        return Payment::findOrFail($id);
    }

    /**
     * updatePayment
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updatePayment(array $data, int $id)
    {
        Payment::findOrFail($id)->update([
            'name' => $data['name'],
        ]);
    }

    /**
     * deletePaymentById
     *
     * @param  mixed $id
     * @return void
     */
    public function deletePaymentById(int $id)
    {
        Payment::findOrFail($id)->delete();
    }

    /**
     * getOrders
     *
     * @param  mixed $r
     * @return void
     */
    public function getOrders(Request $r)
    {
        $s = $r->get('s');
        $s = strtolower($s);
        $orders = Order::whereHas('user', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhereHas('payment', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%")
                ->orWhere('id', 'LIKE', "%$s%");
        })->orWhere('comment', 'LIKE', "%$s%")
            ->orWhere('status', 'LIKE', "%$s%");
        if ($r->route()->named('admin.order.index')) {
            $orders = $orders->paginate(config('app.pagination'))->withQueryString();
        } else {
            $orders = $orders->get();
        }
        foreach ($orders as $order) {
            $total_amount = 0;
            foreach ($order->book as $book) {
                $total_amount = $total_amount + ($book->price * $book->pivot->quantity);
            }
            foreach ($order->ebook as $ebook) {
                $total_amount = $total_amount + $ebook->price;
            }
            $order['total_amount'] = $total_amount;
        }
        return $orders;
    }

    /**
     * getOrderById
     *
     * @param  mixed $id
     * @return void
     */
    public function getOrderById(int $id)
    {
        $order = Order::findOrFail($id);
        $total_amount = 0;
        foreach ($order->book as $book) {
            $total_amount = $total_amount + ($book->price * $book->pivot->quantity);
        }
        foreach ($order->ebook as $ebook) {
            $total_amount = $total_amount + $ebook->price;
        }
        $order['total_amount'] = $total_amount;
        return $order;
    }

    /**
     * updateOrder
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateOrder(array $data, int $id)
    {
        Order::findOrFail($id)->update([
            'status' => $data['status'],
        ]);
        $order = Order::findOrFail($id);
        if ($data['status'] == 'accepted') {
            foreach ($order->ebook as $ebook) {
                UserEbook::create([
                    'user_id' => $order->user->id,
                    'ebook_id' => $ebook->id,
                ]);
            }
        }
    }

    /**
     * getBooks
     *
     * @param  mixed $r
     * @return void
     */
    public function getBooks(Request $r)
    {
        $s = strtolower($r->get('s'));
        $books = Book::whereHas('author', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhereHas('category', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhere('title', 'LIKE', "%$s%")
            ->orWhere('price', 'LIKE', "%$s%");
        if ($r->route()->named('admin.book.index')) {
            return $books->paginate(config('app.pagination'))->withQueryString();
        }
        return $books->get();
    }

    /**
     * getBookById
     *
     * @param  mixed $id
     * @return void
     */
    public function getBookById($id)
    {
        return Book::findOrFail($id);
    }

    /**
     * createBook
     *
     * @param  mixed $data
     * @return void
     */
    public function createBook(BookRequest $data)
    {
        $book = Book::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'pagecount' => $data['pagecount'],
            'price' => $data['price'],
        ]);
        foreach ($data['authors'] as $author) {
            BookAuthor::create([
                'book_id' => $book->id,
                'author_id' => $author,
            ]);
        }
        foreach ($data['categories'] as $category) {
            BookCategory::create([
                'book_id' => $book->id,
                'category_id' => $category,
            ]);
        }
        if ($data->file('cover')) {
            $filename = $book->id . "-book-" . $data->file('cover')->getClientOriginalName();
            $book->cover = '/storage/' . $data->file('cover')->storeAs('covers', $filename, 'public');
        }
        $book->save();
    }

    /**
     * updateBook
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateBook(BookRequest $data, int $id)
    {
        $book = Book::findOrFail($id);
        $book->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'pagecount' => $data['pagecount'],
            'price' => $data['price'],
        ]);
        if ($data->file('cover')) {
            $filename = $book->id . "-book-" . $data->file('cover')->getClientOriginalName();
            $book->cover = '/storage/' . $data->file('cover')->storeAs('covers', $filename, 'public');
        }
        $book->save();
    }

    /**
     * deleteBookById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteBookById(int $id)
    {
        Book::findOrFail($id)->delete();
    }

    /**
     * getEbooks
     *
     * @param  mixed $r
     * @return void
     */
    public function getEbooks(Request $r)
    {
        $s = strtolower($r->get('s'));
        $ebooks = Ebook::whereHas('author', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhereHas('category', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhere('title', 'LIKE', "%$s%")
            ->orWhere('price', 'LIKE', "%$s%");
        if ($r->route()->named('admin.ebook.index')) {
            return $ebooks->paginate(config('app.pagination'))->withQueryString();
        }
        return $ebooks->get();
    }

    /**
     * getEbookById
     *
     * @param  mixed $id
     * @return void
     */
    public function getEbookById($id)
    {
        return Ebook::findOrFail($id);
    }

    /**
     * createEbook
     *
     * @param  mixed $data
     * @return void
     */
    public function createEbook(EbookRequest $data)
    {
        $ebook = Ebook::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'pagecount' => $data['pagecount'],
            'price' => $data['price'],
        ]);
        foreach ($data['authors'] as $author) {
            EbookAuthor::create([
                'ebook_id' => $ebook->id,
                'author_id' => $author,
            ]);
        }
        foreach ($data['categories'] as $category) {
            EbookCategory::create([
                'ebook_id' => $ebook->id,
                'category_id' => $category,
            ]);
        }
        if ($data->file('cover')) {
            $filename = $ebook->id . "-book-" . $data->file('cover')->getClientOriginalName();
            $ebook->cover = '/storage/' . $data->file('cover')->storeAs('covers', $filename, 'public');
        }
        if ($data->file('ebookfile')) {
            $filename = $ebook->id . "-" . $data->file('ebookfile')->getClientOriginalName();
            $ebook->link = $data->file('ebookfile')->storeAs('', $filename, 'private');
        }
        $ebook->save();
    }

    /**
     * updateEbook
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateEbook(EbookRequest $data, int $id)
    {
        $ebook =  Ebook::findOrFail($id);
        $ebook->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'pagecount' => $data['pagecount'],
            'price' => $data['price'],
            'link' => $data['link'],
        ]);
        if ($data->file('cover')) {
            $filename = $ebook->id . "-book-" . $data->file('cover')->getClientOriginalName();
            $ebook->cover = '/storage/' . $data->file('cover')->storeAs('covers', $filename, 'public');
        }
        if ($data->file('ebookfile')) {
            $filename = $ebook->id . "-" . $data->file('ebookfile')->getClientOriginalName();
            $ebook->link = $data->file('ebookfile')->storeAs('', $filename, 'private');
        }
    }

    /**
     * deleteEbookById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteEbookById(int $id)
    {
        Ebook::findOrFail($id)->delete();
    }

    /**
     * getUsers
     *
     * @param  mixed $r
     * @return void
     */
    public function getUsers(Request $r)
    {
        $s = strtolower($r->get('s'));
        $id = Auth::user()->id;
        $users = User::where(function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%")
                ->orwhere('email', 'LIKE', "%$s%");
        })->where('id', 'NOT LIKE', "%$id%");
        if ($r->route()->named('admin.user.index')) {
            return $users->paginate(config('app.pagination'))->withQueryString();
        }
        return $users->get();
    }

    /**
     * getUserById
     *
     * @param  mixed $id
     * @return void
     */
    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    /**
     * updateUser
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateUser(array $data, int $id)
    {
        User::findOrFail($id)->update([
            'role' => $data['role'] == "admin" ? 1 : 0,
            'active' => $data['active'] == "enable" ? 1 : 0,
        ]);
    }

    /**
     * deleteUser
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteUser(int $id)
    {
        User::findOrFail($id)->delete();
    }

    /**
     * getFeedback
     *
     * @param  mixed $r
     * @return void
     */
    public function getFeedback(Request $r)
    {
        $s = strtolower($r->get('s'));
        $feedbacks = Feedback::where('name', 'LIKE', "%$s%")
            ->orWhere('email', 'LIKE', "%$s%")
            ->orWhere('address', 'LIKE', "%$s%")
            ->orWhere('subject', 'LIKE', "%$s%")
            ->orWhere('message', 'LIKE', "%$s%");
        if ($r->route()->named('admin.feedback.index')) {
            return $feedbacks->paginate(config('app.pagination'))->withQueryString();
        }
        return $feedbacks->get();
    }

    /**
     * getFeedbackById
     *
     * @param  mixed $id
     * @return void
     */
    public function getFeedbackById($id)
    {
        return Feedback::findOrFail($id);
    }

    /**
     * deleteFeedback
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteFeedback(int $id)
    {
        Feedback::findOrFail($id)->delete();
    }
}
