<?php

namespace App\Http\Controllers;

use App\Contracts\Services\PublicServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;

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
}
