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
    public function adminProfile(ProfileRequest $data,int $id)
    {
        $input = [
            'name'=>$data['name'],
            'email'=>$data['email'],
            'phone'=>$data['phone'],
            'address'=>$data['address'],
        ];
        if($data->hasFile('image')){
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage['image'];

            if($dbImage != null){
                Storage::delete('public/' . $dbImage);
            }

            $getFile = uniqid() . $data->file('image')->getClientOriginalName();
            $data->file('image')->storeAs('public', $getFile);
           $input['image'] = $getFile;
        }
         User::where('id', $id)->update($input);

    }
    public function getCategories()
    {
        return Category::all();
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
        Category::findOrFail($id)->delete();
    }

    public function getAuthors()
    {
        return Author::all();
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
        Author::findOrFail($id)->delete();
    }

    public function getOrders(Request $r)
    {
        $s = $r->get('s');
        $s = strtolower($s);
        $orders = Order::whereHas('user', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhere('id', 'LIKE', "%$s%")
            ->orWhere('comment', 'LIKE', "%$s%")
            ->orWhere('status', 'LIKE', "%$s%")
            ->get();
        foreach ($orders as $order) {
            $total_amount = 0;
            foreach ($order->book as $book) {
                $total_amount = $total_amount + ($book->price*$book->pivot->quantity);
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
            $total_amount = $total_amount + ($book->price*$book->pivot->quantity);
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
        $filename = $book->id . "-book-" . $data->file('cover')->getClientOriginalName();
        $path = $data->file('cover')->storeAs('uploads', $filename, 'public');
        $book->cover = '/storage/' . $path;
        $book->save();
    }

    public function updateBook(array $data, int $id)
    {
        Book::findOrFail($id)->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'pagecount' => $data['pagecount'],
            'price' => $data['price'],
        ]);
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
            'link' => $data['link'],
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
        $filename = $ebook->id . "-ebook-" . $data->file('cover')->getClientOriginalName();
        $path = $data->file('cover')->storeAs('uploads', $filename, 'public');
        $ebook->cover = '/storage/' . $path;
        $ebook->save();
    }

    public function updateEbook(array $data, int $id)
    {
        Ebook::findOrFail($id)->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'pagecount' => $data['pagecount'],
            'price' => $data['price'],
            'link' => $data['link'],
        ]);
    }

    public function deleteEbookById(int $id)
    {
        Ebook::findOrFail($id)->delete();
    }

    public function getUsers(Request $r)
    {
        $s = strtolower($r->get('s'));
        return User::Where('name', 'LIKE', "%$s%")
            ->orWhere('email', 'LIKE', "%$s%")
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
        //dd($data['active']);
    }

    public function deleteUser(int $id)
    {
        User::findOrFail($id)->delete();
    }

    public function getFeedback(Request $r)
    {
        $s = strtolower($r->get('s'));
        return Feedback::Where('name', 'LIKE', "%$s%")
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
