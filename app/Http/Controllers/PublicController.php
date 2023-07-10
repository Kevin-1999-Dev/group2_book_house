<?php

namespace App\Http\Controllers;

use App\Contracts\Services\PublicServiceInterface;
use App\Http\Controllers\Controller;
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
}
