<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Ebook;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Category;
use App\Models\BookOrder;
use App\Models\EbookOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FeedbackRequest;
use App\Contracts\Services\PublicServiceInterface;

class PublicController extends Controller
{
    private $publicService;
    /**
     * __construct
     *
     * @param  mixed $publicServiceInterface
     * @return void
     */
    public function __construct(PublicServiceInterface $publicServiceInterface)
    {
        $this->publicService = $publicServiceInterface;
    }
    /**
     * home
     *
     * @return void
     */
    public function home()
    {
        $data = $this->publicService->getAll();
        $books = $data->books;
        $ebooks = $data->ebooks;

        return view('public.index', compact('books', 'ebooks'));
    }
    /**
     * books
     *
     * @param  mixed $r
     * @return void
     */
    public function book(Request $r)
    {
        $books = $this->publicService->getbooks();
        $categories = Category::get();
        $s = strtolower($r->get('s'));
        $sort = strtolower($r->get('sort'));
        $books = Book::whereHas('author', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhereHas('category', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhere('title', 'LIKE', "%$s%")
            ->orWhere('price', 'LIKE', "%$s%");
        if ($sort == "asc") {
            $books = $books->orderBy('created_at', 'asc')->get();
            foreach ($books as $book) {
                $book['date'] = date_format($book->created_at, "m/d/Y");
            }
        } elseif ($sort == "desc") {
            $books = $books->orderBy('created_at', 'desc')->get();
            foreach ($books as $book) {
                $book['date'] = date_format($book->created_at, "m/d/Y");
            }
        } else {
            $books = $books->get();
            foreach ($books as $book) {
                $book['date'] = date_format($book->created_at, "m/d/Y");
            }
        }
        return view('public.book', compact('books', 'categories'));
    }
    /**
     * ebook
     *
     * @param  mixed $r
     * @return void
     */
    public function ebook(Request $r)
    {
        $ebooks = $this->publicService->getebooks();
        $s = strtolower($r->get('s'));
        $sort = strtolower($r->get('sort'));
        $ebooks = Ebook::whereHas('author', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhereHas('category', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhere('title', 'LIKE', "%$s%")
            ->orWhere('price', 'LIKE', "%$s%");
        if ($sort == "asc") {
            $ebooks = $ebooks->orderBy('created_at', 'asc')->get();
            foreach ($ebooks as $ebook) {
                $ebook['date'] = date_format($ebook->created_at, "m/d/Y");
            }
        } elseif ($sort == "desc") {
            $ebooks = $ebooks->orderBy('created_at', 'desc')->get();
            foreach ($ebooks as $ebook) {
                $ebook['date'] = date_format($ebook->created_at, "m/d/Y");
            }
        } else {
            $ebooks = $ebooks->get();
            foreach ($ebooks as $ebook) {
                $ebook['date'] = date_format($ebook->created_at, "m/d/Y");
            }
        }
        return view('public.ebook', compact('ebooks'));
    }
    /**
     * ebookAsc
     *
     * @param  mixed $r
     * @return void
     */
    public function ebookAsc(Request $r)
    {
        $ebooks = $this->publicService->getebooks();
        $s = strtolower($r->get('s'));
        $ebooks = Ebook::whereHas('author', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhereHas('category', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhere('title', 'LIKE', "%$s%")
            ->orWhere('price', 'LIKE', "%$s%")
            ->orderBy('created_at', 'asc')
            ->get();
        foreach ($ebooks as $ebook) {
            $ebook['date'] = date_format($ebook->created_at, "m/d/Y");
        }

        return view('public.ebook', compact('ebooks'));
    }
    /**
     * ebookDesc
     *
     * @param  mixed $r
     * @return void
     */
    public function ebookDesc(Request $r)
    {
        $ebooks = $this->publicService->getebooks();
        $s = strtolower($r->get('s'));
        $ebooks = Ebook::whereHas('author', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhereHas('category', function ($query) use ($s) {
            $query->where('name', 'LIKE', "%$s%");
        })->orWhere('title', 'LIKE', "%$s%")
            ->orWhere('price', 'LIKE', "%$s%")
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($ebooks as $ebook) {
            $ebook['date'] = date_format($ebook->created_at, "m/d/Y");
        }

        return view('public.ebook', compact('ebooks'));
    }
    /**
     * show_book
     *
     * @param  mixed $id
     * @return void
     */
    public function show_book($id)
    {
        $book = $this->publicService->getBookById($id);

        return view('public.book_detail', compact('book'));
    }
    /**
     * show_ebook
     *
     * @param  mixed $id
     * @return void
     */
    public function show_ebook($id)
    {
        $ebook = $this->publicService->getEbookById($id);

        return view('public.ebook_detail', compact('ebook'));
    }
    /**
     * feedback
     *
     * @return void
     */
    public function feedback()
    {
        return view('public.contact_us');
    }
    public function storeFeedback(FeedbackRequest $request)
    {
        if (empty(Auth::user())) {
            $this->publicService->createFeedback($request->only([
                'name',
                'email',
                'address',
                'subject',
                'message',
            ]));
        } else {
            $this->publicService->createFeedback($request->only([
                'subject',
                'message',
            ]));
        }
        return redirect()->route('public.contact_us')->with('success', 'Thank you for your feedback');
    }
    /**
     * cartIndex
     *
     * @return void
     */
    public function cartIndex()
    {
        $payments = Payment::all();
        return view('public.cart.index', compact('payments'));
    }
    /**
     * cartInfo
     *
     * @return void
     */
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
    /**
     * cartAddBook
     *
     * @param  mixed $r
     * @param  mixed $id
     * @return void
     */
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
    /**
     * cartAddEbook
     *
     * @param  mixed $id
     * @return void
     */
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
    /**
     * cartDelete
     *
     * @param  mixed $type
     * @param  mixed $id
     * @return void
     */
    public function cartDelete(string $type, int $id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$type][$id])) {
            unset($cart[$type][$id]);
            session()->put('cart', $cart);
        }
    }
    /**
     * cartStore
     *
     * @param  mixed $r
     * @return void
     */
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
            return redirect()->route('user.order.index')->with('success', 'Order Success. Thank you for your order');
        } else {
            return redirect()->route('auth.loginPage');
        }
    }
}
