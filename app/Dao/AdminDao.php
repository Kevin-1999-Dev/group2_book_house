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
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Storage;
use App\Contracts\Dao\AdminDaoInterface;
use App\Models\Feedback;
use App\Models\Payment;
use App\Models\UserEbook;
use Illuminate\Validation\Rules\File;

class AdminDao implements AdminDaoInterface
{
    public function password(array $data)
    {
        $id = Auth::user()->id;
        $user = User::select('password')->where('id', $id)->first();
        $dbPassword = $user->password;
        $userOldPassword = $data['oldPassword'];

        if (Hash::check($userOldPassword, $dbPassword)) {
            User::where('id', $id)->update([
                'password' => Hash::make($data['newPassword']),
            ]);
            Auth::logout();
        }
    }
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
    public function getCategories(Request $r)
    {
        $s = strtolower($r->get('s'));
        return Category::Where('name', 'LIKE', "%$s%")->get();
    }

    public function createCategory(array $data)
    {
        Category::create([
            'name' => $data['name'],
        ]);
    }

    public function getCategoryById(int $id)
    {
        return Category::findOrFail($id);
    }
    public function updateCategory(array $data, int $id)
    {
        Category::findOrFail($id)->update([
            'name' => $data['name'],
        ]);
    }

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

    public function getAuthors(Request $r)
    {
        $s = strtolower($r->get('s'));
        return Author::Where('name', 'LIKE', "%$s%")->get();
    }

    public function createAuthor(array $data)
    {
        Author::create([
            'name' => $data['name'],
        ]);
    }

    public function getAuthorById(int $id)
    {
        return Author::findOrFail($id);
    }

    public function updateAuthor(array $data, int $id)
    {
        Author::findOrFail($id)->update([
            'name' => $data['name'],
        ]);
    }

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

    public function getPayments(Request $r)
    {
        $s = strtolower($r->get('s'));
        return Payment::Where('name', 'LIKE', "%$s%")->get();
    }

    public function createPayment(array $data)
    {
        Payment::create([
            'name' => $data['name'],
        ]);
    }

    public function getPaymentById(int $id)
    {
        return Payment::findOrFail($id);
    }

    public function updatePayment(array $data, int $id)
    {
        Payment::findOrFail($id)->update([
            'name' => $data['name'],
        ]);
    }

    public function deletePaymentById(int $id)
    {
        Payment::findOrFail($id)->delete();
    }

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
            ->orWhere('status', 'LIKE', "%$s%")
            ->get();
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

    public function getBooks(Request $r)
    {
        $s = strtolower($r->get('s'));
        return Book::whereHas('author', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhereHas('category', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhere('title', 'LIKE', "%$s%")
            ->orWhere('price', 'LIKE', "%$s%")
            ->get();
    }

    public function getBookById($id)
    {
        return Book::findOrFail($id);
    }

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

    public function deleteBookById(int $id)
    {
        Book::findOrFail($id)->delete();
    }

    public function getEbooks(Request $r)
    {
        $s = strtolower($r->get('s'));
        return Ebook::whereHas('author', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhereHas('category', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhere('title', 'LIKE', "%$s%")
            ->orWhere('price', 'LIKE', "%$s%")
            ->get();
    }

    public function getEbookById($id)
    {
        return Ebook::findOrFail($id);
    }

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

    public function deleteEbookById(int $id)
    {
        Ebook::findOrFail($id)->delete();
    }

    public function getUsers(Request $r)
    {
        $s = strtolower($r->get('s'));
        $id = Auth::user()->id;
        return User::where(function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%")
                ->orwhere('email', 'LIKE', "%$s%");
        })->where('id', 'NOT LIKE', "%$id%")
            ->get();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function updateUser(array $data, int $id)
    {
        User::findOrFail($id)->update([
            'role' => $data['role'] == "admin" ? 1 : 0,
            'active' => $data['active'] == "enable" ? 1 : 0,
        ]);
    }

    public function deleteUser(int $id)
    {
        User::findOrFail($id)->delete();
    }

    public function getFeedback(Request $r)
    {
        $s = strtolower($r->get('s'));
        return Feedback::where('name', 'LIKE', "%$s%")
            ->orWhere('email', 'LIKE', "%$s%")
            ->orWhere('address', 'LIKE', "%$s%")
            ->orWhere('subject', 'LIKE', "%$s%")
            ->orWhere('message', 'LIKE', "%$s%")
            ->get();
    }

    public function getFeedbackById($id)
    {
        return Feedback::findOrFail($id);
    }

    public function deleteFeedback(int $id)
    {
        Feedback::findOrFail($id)->delete();
    }
}
