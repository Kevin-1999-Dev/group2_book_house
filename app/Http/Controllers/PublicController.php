<?php

namespace App\Http\Controllers;

use App\Contracts\Services\PublicServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Models\Book;
use App\Models\BookOrder;
use App\Models\Ebook;
use App\Models\EbookOrder;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    private $publicService;

    public function __construct(PublicServiceInterface $publicServiceInterface)
    {
        $this->publicService = $publicServiceInterface;
    }

    public function home()
    {
        $books = $this->publicService->getbooks();
        $ebooks = $this->publicService->getebooks();

        return view('public.index', compact('books', 'ebooks'));
    }


    public function index()
    {
        $books = $this->publicService->getbooks();

        return view('public.book', compact('books'));
    }

    public function ebook()
    {
        $ebooks = $this->publicService->getebooks();

        return view('public.ebook', compact('ebooks'));
    }

    public function show_book($id)
    {
        $book = $this->publicService->getBookById($id);

        return view('public.book_detail', compact('book'));
    }

    public function show_ebook($id)
    {
        $ebook = $this->publicService->getEbookById($id);

        return view('public.ebook_detail', compact('ebook'));
    }

    public function feedback()
    {
        return view('public.contact_us');
    }

    public function storeFeedback(FeedbackRequest $request)
    {
        $this->publicService->createFeedback($request->only([
            'name',
            'email',
            'address',
            'subject',
            'message',
        ]));
        return redirect()->route('public.contact_us')->with('success', 'Thank you for your feedback');
    }

    public function cartIndex()
    {
        $payments = Payment::all();
        return view('public.cart.index', compact('payments'));
    }

    public function cartInfo()
    {
        $cart = session()->get('cart');
        $totalitem = 0;
        if (isset($cart['book'])) {
            foreach (array_column($cart['book'], 'quantity') as $quantity) {
                $totalitem = $totalitem + $quantity;
            }
        }
        if (isset($cart['ebook'])) {
            $totalitem = $totalitem + count($cart['ebook']);
        }
        $cart['totalItem'] = $totalitem;
        session()->put('cart', $cart);
        return session()->get('cart');
    }

    public function cartAddBook(Request $r, int $id)
    {
        $book = Book::findOrFail($id);
        $cart = session()->get('cart');
        if (isset($cart['book'][$id])) {
            if ($r->get('s')) {
                $cart['book'][$id]['quantity'] = $cart['book'][$id]['quantity'] + $r->get('s');
            } else {
                $cart['book'][$id]['quantity']++;
            }
        } else {
            $cart['book'][$id] = [
                'id' => $book->id,
                'title' => $book->title,
                'quantity' => 1,
                'price' => $book->price,
            ];
        }
        session()->put('cart', $cart);
    }

    public function cartAddEbook(int $id)
    {
        $ebook = Ebook::findOrFail($id);
        $cart = session()->get('cart');
        $cart['ebook'][$id] = [
            'id' => $ebook->id,
            'title' => $ebook->title,
            'price' => $ebook->price,
        ];
        session()->put('cart', $cart);
    }

    public function cartDelete(string $type, int $id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$type][$id])) {
            unset($cart[$type][$id]);
            session()->put('cart', $cart);
        }
    }

    public function cartStore(Request $r)
    {
        if ($r->user()) {
            $cart = session()->get('cart');
            $order = Order::create([
                'payment_id' => $r['payment'],
                'user_id' => $r->user()->id,
            ]);
            if (isset($cart['book']) && count($cart['book'])) {
                foreach ($cart['book'] as $book) {
                    BookOrder::create([
                        'quantity' => $book['quantity'],
                        'book_id' => $book['id'],
                        'order_id' => $order->id,
                    ]);
                }
            }
            if (isset($cart['ebook']) && count($cart['ebook'])) {
                foreach ($cart['ebook'] as $ebook) {
                    EbookOrder::create([
                        'ebook_id' => $ebook['id'],
                        'order_id' => $order->id,
                    ]);
                }
            }
            session()->forget('cart');
            return redirect()->route('public.contact_us')->with('success', 'Order Success. Thank you for your order');
        } else {
            return redirect()->route('auth.loginPage');
        }
    }
}
