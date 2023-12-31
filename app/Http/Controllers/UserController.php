<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ebook;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Contracts\Services\UserServiceInterface;
use App\Models\UserEbook;

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
    public function changePassword(PasswordRequest $request,$id)
    {
        $user = User::select('password')->where('id', $id)->first();
        $dbPassword = $user->password;
        $userOldPassword = $request->oldPassword;

        if (Hash::check($userOldPassword, $dbPassword)) {
            User::where('id', $id)->update([
                'password' => Hash::make($request->newPassword),
            ]);
            Auth::logout();
            return redirect()->route('auth.loginPage')->with(['successPwChange' => 'Successfully Change Password...']);
        }else{
            return back()->with(['notMatch' => 'The Old Password not Match. Try Again!']);
        }


    }
    public function updateUser(ProfileRequest $request, int $id)
    {
        $this->userService->userProfile($request, $id);
        return redirect()->route('user.details');
    }

    public function orderIndex(Request $r)
    {
        $s = $r->get('s');
        $s = strtolower($s);
        $user = $r->user()->id;
        $orders = Order::where('user_id','=',$user)
        ->where(function($orderquery) use ($s) {
           $orderquery->WhereHas('payment', function ($query) use ($s) {
                $query->where('name', 'LIKE', "%$s%")
                    ->orWhere('id', 'LIKE', "%$s%");
            })->orWhere('status', 'LIKE', "%$s%");
        })->get();
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

    public function orderCancel(Request $r, int $id)
    {
        $order = Order::findOrfail($id);
        if ($order->user->id == $r->user()->id) {
            $order->update([
                'status' => 'cancelled',
            ]);
            return redirect()->route('user.order.index');
        }
    }

    public function userPrivateServe(Request $r, String $filename)
    {
        $user = User::where('id',$r->user()->id);
        $exists = $user->whereHas('ebook',function ($query) use ($filename) {
            $query->where('link','LIKE',"%$filename%");
        })->exists();
        if ($exists) {
            $ebook = Ebook::where('link', 'LIKE', "%$filename%")->first();
            return response()->download(storage_path("/app/private/" . $ebook->link));
        } else {
            return abort('401');
        }
    }
    public function delete(int $id)
    {
        $this->userService->deleteAcc($id);
        return redirect()->route('public.index');
    }
}
