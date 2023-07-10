<?php

namespace App\Dao;

use App\Contracts\Dao\AdminDaoInterface;
use App\Models\Category;
use App\Models\Author;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminDao implements AdminDaoInterface
{
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
            $query->where('name', 'LIKE', '%' . $s . '%');
        })->orWhere('id', 'LIKE', '%' . $s . '%')
            ->orWhere('comment', 'LIKE', '%' . $s . '%')
            ->orWhere('status', 'LIKE', '%' . $s . '%')
            ->get();
        foreach ($orders as $order) {
            $total_amount = 0;
            foreach ($order->book as $book) {
                $total_amount = $total_amount + $book->price;
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
            $total_amount = $total_amount + $book->price;
        }
        foreach ($order->ebook as $ebook) {
            $total_amount = $total_amount + $ebook->price;
        }
        $order['total_amount'] = $total_amount;

        return $order;
    }

    public function acceptOrderById(int $id)
    {
        return Order::findOrFail($id)->update([
            'status' => 'accepted',
        ]);
    }

    public function declineOrderById(int $id)
    {
        return Order::findOrFail($id)->update([
            'status' => 'declined',
        ]);
    }
}
