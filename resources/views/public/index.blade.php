@extends('layouts.master')
@section('content')
<div class="container">
  <div class="row g-3 d-flex align-items-center">
    <div class="col-md-6 col-sm-12">
      <div class="">
        <div class="card-body p-5">
          <img src="{{ asset('images/img_index_md.png') }}" alt="" class="d-none d-md-block d-lg-none md-img">
          <img src="{{ asset('images/img_index_book.jpg') }}" alt="">
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-12">
      <div class="px-5 pt-lg-5">
        <div class="card-body pb-3 py-md-5 mv-txt">
          <h2>Welcome to <span class="bookhouse">BOOK HOUSE</span>!!! <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-emoji-heart-eyes" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
              <path d="M11.315 10.014a.5.5 0 0 1 .548.736A4.498 4.498 0 0 1 7.965 13a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .548-.736h.005l.017.005.067.015.252.055c.215.046.515.108.857.169.693.124 1.522.242 2.152.242.63 0 1.46-.118 2.152-.242a26.58 26.58 0 0 0 1.109-.224l.067-.015.017-.004.005-.002zM4.756 4.566c.763-1.424 4.02-.12.952 3.434-4.496-1.596-2.35-4.298-.952-3.434zm6.488 0c1.398-.864 3.544 1.838-.952 3.434-3.067-3.554.19-4.858.952-3.434z" />
            </svg></h2>
          <p class="fs-5">
            your <span class="mark-txt">premier destination</span> for both printed books and
            digital ebooks is <spam class="mark-txt">here</spam>.<br><span class="mark-txt">Immerse yourself</span> in a world of
            captivating stories and boundless knowledge.<br><span class="mark-txt">Unleash your imagination</span> as you explore our vast collection
            of titles, carefully curated to satisfy every reader's taste.
          </p>
          <p>Whether you prefer the tactile experience of
            turning pages or the convenience of digital reading, <span class="bookhouse fs-5">BOOK HOUSE</span> is here to accompany you on your literary
            journey.
          </p>
          @if (empty(Auth::user()))
          <span class="alert-txt">Create or login to your own account and unlock a world of amazing books.
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
</div>
<div class="container-fluid border-bottom border-top border-info py-3 bg-body-secondary">
  <div class="row">
    <!-- Books -->
    <div class="col-md-6 mb-2">
      <div class="card shadow-sm">
        <h3 class="py-md-1 shadow-sm p-2 border-bottom border-info-subtle">Avilable Books</h3>
        <div class="card-body">
          <div class="row row-cols-2 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-3 mb-3">
            @foreach ($books as $book)
            <a href="{{ route('public.book_detail', $book->id) }}">
              <div class="col book-card">
                <div class="card shadow-sm bg-body-secondary">
                  <div class="card-body">
                    <img src="{{$book->cover}}" alt="book-cover" class="book rounded-top-2 d-block mx-auto">
                    <h2 class="fs-5">{{$book->title}}</h2>
                    <p class="m-0">
                      @foreach ($book->author as $author)
                      {{$author->name}}<br>
                      @endforeach
                      @foreach ($book->category as $category)
                      <span class="bg-info px-1 rounded-1">{{$category->name}}</span><br>
                      @endforeach
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">
                        <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z" />
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                      </svg>
                      <span class="price">: {{$book->price}}MMK</span>
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
        <h3 class="py-md-1 shadow-sm p-2 border-bottom border-info-subtle">Avilable E-books</h3>
        <div class="card-body">
          <div class="row row-cols-2 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-3 mb-3">
            @foreach ($ebooks as $ebook)
            <a href="{{ route('public.ebook_detail', $ebook->id) }}">
              <div class="col book-card">
                <div class="card shadow-sm bg-body-secondary">
                  <div class="card-body">
                    <img src="{{$ebook->cover}}" alt="book-cover" class="book rounded-top-2 d-block mx-auto">
                    <h2 class="fs-5">{{$ebook->title}}</h2>
                    <p class="m-0">
                      @foreach ($ebook->author as $author)
                      {{$author->name}}<br>
                      @endforeach
                      @foreach ($ebook->category as $category)
                      <span class="bg-info px-1 rounded-1">{{$category->name}}</span><br>
                      @endforeach
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">
                        <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z" />
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                      </svg>
                      <span class="price">: {{$ebook->price}}MMK</span>
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