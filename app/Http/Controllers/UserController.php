<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Contracts\Services\UserServiceInterface;
use App\Models\Order;
use App\Models\User;

class UserController extends Controller
{
    public function userDash()
    {
        return view('user.dashboard');
    }
    public function changePasswordPage()
    {
        return view('user.profile.change');
    }
    public function profilePage()
    {
        return view('user.profile.details');
    }
    public function editPage()
    {
        return view('user.profile.edit');
    }
    private $userService;

    public function __construct(UserServiceInterface $userServiceInterface)
    {
        $this->userService = $userServiceInterface;
    }
    public function changePassword(PasswordRequest $r)
    {
        $this->userService->password($r->only([
            'oldPassword',
            'newPassword',
            'confirmPassword',
        ]));
        return redirect()->route('auth.loginPage')->with(['successPwChange' => 'Successfully Change Password...']);
    }
    public function updateUser(ProfileRequest $request, int $id)
    {
        $this->userService->userProfile($request, $id);
        return redirect()->route('user.details');
    }

    public function orderIndex(Request $r)
    {
        $user = User::findOrfail($r->user()->id);
        $orders = $user->order()->get();
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
        return view('user.order.index', compact('orders'));
    }

    public function orderDetail(Request $r, int $id)
    {
        $user = User::findOrfail($r->user()->id);
        $order = Order::findOrfail($id);
        if ($order->user->id == $r->user()->id) {
            $total_amount = 0;
            foreach ($order->book as $book) {
                $total_amount = $total_amount + ($book->price * $book->pivot->quantity);
            }
            foreach ($order->ebook as $ebook) {
                $total_amount = $total_amount + $ebook->price;
            }
            $order['total_amount'] = $total_amount;
            return view('user.order.detail', compact('order'));
        }
    }
}
