@extends('layouts.master')
@section('title')
Book Page
@endsection
@section('content')
<div class="px-3 px-md-3 px-lg-5 book-pg">
  <div class="d-md-none pt-2">
    <h2 class="f-3 fw-bold">Discover a World of Available Books</h2>
    <p class="f-6">Explore our collection and choose a book that satisfies your reading cravings.</p>
    <div class="clearfix mt-2">
      <span class="dropdown float-startend me-2">
        <button class="btn btn-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa-solid fa-arrow-right-arrow-left"></i>
        </button>
        <ul class="dropdown-menu">
          <li><a href="{{ route('public.book.asc') }}" class="dropdown-item" type="button">Ascending</a></li>
          <li><a href="{{ route('public.book.desc') }}" class="dropdown-item" type="button">Descending</a></li>
        </ul>
      </span>
      <form action="{{ route('public.book') }}" method="GET" class="float-end col-10 text-end">
        <div class="form-group d-inline-block col-8">
          <input type="text" name="s" class="form-control" placeholder="Search" value="{{Request::get('s')}}" />
        </div>
        <button type="submit" class="btn btn-outline-danger d-inline">Search</button>
      </form>
    </div>
  </div>
  <div class="clearfix d-none d-md-block pt-4 pt-md-0">
    <div class="float-start col-6">
      <h2 class="f-3 fw-bold">Discover a World of Available Books</h2>
      <p class="f-6">Explore our collection and choose a book that satisfies your reading cravings.</p>
    </div>
    <form action="{{ route('public.book') }}" method="GET" class="float-end">
      <div class="form-group d-inline-block">
        <input type="text" name="s" class="form-control" placeholder="Search" value="{{Request::get('s')}}" />
      </div>
      <button type="submit" class="btn btn-outline-danger d-inline">Search</button>
    </form>
    <span class="dropdown float-end me-2">
      <button class="btn btn-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-arrow-right-arrow-left"></i>
      </button>
      <ul class="dropdown-menu">
        <li><a href="{{ route('public.book.asc') }}" class="dropdown-item" type="button">Ascending</a></li>
        <li><a href="{{ route('public.book.desc') }}" class="dropdown-item" type="button">Descending</a></li>
      </ul>
    </span>
  </div>
  <div class="my-3 row">
    @foreach ($books as $book)
    <a href="{{ route('public.book_detail', $book->id) }}" class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
      <div class="card shadow-sm bg-body-secondary">
        <div class="card-body book-card">
          <img src="{{$book->cover}}" alt="book-cover" class="book-cover rounded-top-2 d-block mx-auto mb-1">
          <h2 class="f-6 fw-bold">{{$book->title}}</h2>
          <p class="f-s mb-lg-1">
            @foreach ($book->author as $author)
            {{$author->name}}
            @if (!($loop->last))
            /
            @endif
            @endforeach
          </p>
          @foreach ($book->category as $category)
          <span class="bg-danger-subtle px-1 rounded-1 f-s">{{$category->name}}</span>
          @endforeach
          <p class="f-s mt-1">
            <i class="fa-solid fa-calendar-days"></i> : {{$book->date}}
          </p>
          <p class="f-s mt-1">
            <i class="fa-solid fa-hand-holding-dollar"></i> : {{$book->price}}MMK
          </p>
        </div>
      </div>
      @endforeach
  </div>
</div>
@endsection