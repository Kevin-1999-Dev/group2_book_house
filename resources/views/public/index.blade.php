@extends('layouts.master')
@section('title')
Home Page
@endsection
@section('content')
<div class="col-lg-10 mx-auto mv d-flex align-items-center my-3 mt-md-0">
    <div class="intro row d-flex align-items-center">
        <div class="col-md-6 col-sm-12 px-5 mb-4 mb-md-0">
            <div class="card-body p-3 p-md-0 p-lg-5">
                <img src="{{ asset('images/img_index_book.jpg') }}" alt="book image">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card-body mv-txt mx-4 mx-md-0 me-md-3 mx-lg-5 p-2 p-md-0">
                <h2 class="f-2 mb-3">Welcome to BOOK HOUSE!!! <i class="fa-regular fa-face-grin-hearts"></i></h2>
                <p class="f-5 mb-3">Whether you prefer the tactile experience of
                    turning pages or the convenience of digital reading, <span class="f-4">BOOK HOUSE</span>
                    is here to accompany you on your literary
                    journey.
                </p>
                @if (empty(Auth::user()))
                <span class="alert-txt f-6">Create or login to your own account and unlock a world of amazing books.
                    <i class="fa-regular fa-face-smile-wink"></i>
                </span>
                @else
                @if (Auth::user()->role == 1)
                <a href="{{ route('user.order.index') }}" class="btn btn-dark btn-sm">See your books</a>
                @else
                <a href="{{ route('user.order.index') }}" class="btn btn-dark btn-sm">See your books</a>
                @endif
                @endif
            </div>
        </div>
    </div>
</div>
<div class="container-fluid border-top border-danger-subtle py-3 bg-body-secondary">
    <div class="row  px-1 px-lg-2">
        <!-- Books -->
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <h3 class="card-header shadow-sm border-bottom border-danger-subtle f-4">Avilable Books</h3>
                <div class="card-body book-box">
                    <div class="row">
                        @foreach ($books as $book)
                        <a href="{{ route('public.book_detail', $book->id) }}" class="col-6 col-sm-4 col-md-6 col-lg-4 mb-3">
                            <div class="card shadow-sm bg-body-secondary">
                                <div class="card-body book-card">
                                    <img src="{{ $book->cover }}" alt="book-cover" class="book-cover rounded-top-2 d-block mx-auto mb-1">
                                    <h2 class="f-6 fw-bold">{{ $book->title }}</h2>
                                    <p class="f-s mb-1">
                                        @foreach ($book->author as $author)
                                        {{ $author->name }}
                                        @if (!$loop->last)
                                        /
                                        @endif
                                        @endforeach
                                    </p>
                                    @foreach ($book->category as $category)
                                    <span class="bg-danger-subtle px-1 rounded-1 f-s">{{ $category->name }}</span>
                                    @endforeach
                                    <p class="f-s mt-1">
                                        <i class="fa-solid fa-hand-holding-dollar"></i> : {{ $book->price }}MMK
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        <div class="d-grid gap-2 col-12 mb-4 mb-lg-0">
                            <a class="btn btn-sm btn-dark col-6 mx-auto" type="button" href="{{ route('public.book') }}">See More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ebooks -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <h3 class="card-header shadow-sm border-bottom border-danger-subtle f-4">Avilable E-books</h3>
                <div class="card-body book-box">
                    <div class="row">
                        @foreach ($ebooks as $ebook)
                        <a href="{{ route('public.ebook_detail', $ebook->id) }}" class="col-6 col-sm-4 col-md-6 col-lg-4 mb-3">
                            <div class="card shadow-sm bg-body-secondary">
                                <div class="card-body book-card">
                                    <img src="{{ $ebook->cover }}" alt="book-cover" class="book-cover rounded-top-2 d-block mx-auto mb-1">
                                    <h2 class="f-6 fw-bold">{{ $ebook->title }}</h2>
                                    <p class="f-s mb-1">
                                        @foreach ($ebook->author as $author)
                                        {{ $author->name }}
                                        @if (!$loop->last)
                                        /
                                        @endif
                                        @endforeach
                                    </p>
                                    @foreach ($ebook->category as $category)
                                    <span class="bg-danger-subtle px-1 rounded-1 f-s">{{ $category->name }}</span>
                                    @endforeach
                                    <p class="f-s mt-1">
                                        <i class="fa-solid fa-hand-holding-dollar"></i> : {{ $ebook->price }}MMK
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        <div class="d-grid gap-2 col-12 mb-4 mb-lg-0">
                            <a class="btn btn-sm btn-dark col-6 mx-auto" type="button" href="{{ route('public.ebook') }}">See More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
