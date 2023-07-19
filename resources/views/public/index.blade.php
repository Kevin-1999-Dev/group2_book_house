@extends('layouts.master')

@section('title')
Home Page
@endsection
@section('content')
<div class="col-lg-10 mx-auto mv d-flex align-items-center my-5 mt-md-0">
  <div class="intro row d-flex align-items-center">
    <div class="col-md-6 col-sm-12 px-5 mb-4 mb-md-0">
      <div class="card-body p-lg-5">
        <img src="{{ asset('images/img_index_book.jpg') }}" alt="book image">
      </div>
    </div>
    <div class="col-md-6 col-sm-12">
      <div class="card-body mv-txt mx-3 mx-lg-5">
        <h2 class="f-2 mb-3">Welcome to <span class="bookhouse">BOOK HOUSE</span>!!! <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-emoji-heart-eyes" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path d="M11.315 10.014a.5.5 0 0 1 .548.736A4.498 4.498 0 0 1 7.965 13a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .548-.736h.005l.017.005.067.015.252.055c.215.046.515.108.857.169.693.124 1.522.242 2.152.242.63 0 1.46-.118 2.152-.242a26.58 26.58 0 0 0 1.109-.224l.067-.015.017-.004.005-.002zM4.756 4.566c.763-1.424 4.02-.12.952 3.434-4.496-1.596-2.35-4.298-.952-3.434zm6.488 0c1.398-.864 3.544 1.838-.952 3.434-3.067-3.554.19-4.858.952-3.434z" />
          </svg></h2>
        <p class="f-4 mb-2">
          your <span class="mark-txt">premier destination</span> for both printed books and
          digital ebooks is <spam class="mark-txt">here</spam>.<br><span class="mark-txt">Immerse yourself</span> in a world of
          captivating stories and boundless knowledge.<br><span class="mark-txt">Unleash your imagination</span> as you explore our vast collection
          of titles, carefully curated to satisfy every reader's taste.
        </p>
        <p class="f-6 mb-3">Whether you prefer the tactile experience of
          turning pages or the convenience of digital reading, <span class="bookhouse f-5">BOOK HOUSE</span> is here to accompany you on your literary
          journey.
        </p>
        @if (empty(Auth::user()))
        <span class="alert-txt f-6">Create or login to your own account and unlock a world of amazing books.
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-smile-upside-down" viewBox="0 0 16 16">
            <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zm0-1a8 8 0 1 1 0 16A8 8 0 0 1 8 0z" />
            <path d="M4.285 6.433a.5.5 0 0 0 .683-.183A3.498 3.498 0 0 1 8 4.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.498 4.498 0 0 0 8 3.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683zM7 9.5C7 8.672 6.552 8 6 8s-1 .672-1 1.5.448 1.5 1 1.5 1-.672 1-1.5zm4 0c0-.828-.448-1.5-1-1.5s-1 .672-1 1.5.448 1.5 1 1.5 1-.672 1-1.5z" />
          </svg>
        </span>
        @else
        <a href="" class="btn btn-dark btn-sm">See your books</a>
        @endif
      </div>
    </div>
  </div>
</div>
<div class="container-fluid border-bottom border-top border-danger-subtle py-3 bg-body-secondary">
  <div class="row d-flex flex-wrap">
    <!-- Books -->
    <div class="col-md-6 mb-3">
      <div class="card shadow-sm">
        <h3 class="card-header shadow-sm border-bottom border-danger-subtle f-5">Avilable Books</h3>
        <div class="card-body book-box">
          <div class="row row-cols-2 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-3 mb-3">
            @foreach ($books as $book)
            <a href="{{ route('public.book_detail', $book->id) }}">
              <div class="col">
                <div class="card shadow-sm bg-body-secondary">
                  <div class="card-body book-card">
                    <img src="{{$book->cover}}" alt="book-cover" class="book-cover rounded-top-2 d-block mx-auto">
                    <h2 class="f-6 fw-bold">{{$book->title}}</h2>
                    <p class="f-s mb-1">
                      @foreach ($book->author as $author)
                      {{$author->name}}
                      @endforeach
                    </p>
                      @foreach ($book->category as $category)
                      <span class="bg-info px-1 rounded-1 f-s">{{$category->name}}</span>
                      @endforeach
                      <p class="f-s mt-1">
                      <i class="fa-solid fa-hand-holding-dollar"></i> : {{$book->price}}MMK
                      </p>
                  </div>
                </div>
              </div>
            </a>
            @endforeach
          </div>
          <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-dark" type="button">See More</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Ebooks -->
    <div class="col-md-6">
      <div class="card shadow-sm">
        <h3 class="card-header shadow-sm border-bottom border-danger-subtle f-5">Avilable E-books</h3>
        <div class="card-body book-box">
          <div class="row row-cols-2 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 mb-3">
            @foreach ($ebooks as $ebook)
            <a href="{{ route('public.ebook_detail', $ebook->id) }}">
              <div class="col">
                <div class="card shadow-sm bg-body-secondary">
                  <div class="card-body book-card">
                    <img src="{{$ebook->cover}}" alt="book-cover" class="book-cover rounded-top-2 d-block mx-auto">
                    <h2 class="f-6 fw-bold">{{$ebook->title}}</h2>
                    <p class="f-s mb-1">
                      @foreach ($ebook->author as $author)
                      {{$author->name}}
                      @endforeach
                    </p>
                    @foreach ($ebook->category as $category)
                    <span class="bg-info px-1 rounded-1 f-s">{{$category->name}}</span>
                    @endforeach
                    <p class="f-s mt-1">
                      <i class="fa-solid fa-hand-holding-dollar"></i> : {{$ebook->price}}MMK
                    </p>
                  </div>
                </div>
              </div>
            </a>
            @endforeach
          </div>
          <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-dark" type="button">See More</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
