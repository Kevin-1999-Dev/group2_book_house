@extends('layouts.master')
@section('title')
Ebook Page
@endsection
@section('content')
<div class="container-fluid px-lg-5 ebook-pg">
  <div class="d-md-none pt-5">
    <h2 class="f-3 fw-bold">Discover a World of Available EBooks</h2>
    <p class="f-6">Explore our collection and choose a book that satisfies your reading cravings. You will get the ebook download link.</p>
    <form action="{{ route('public.ebook') }}" method="GET" class="mt-2 text-center">
      <div class="form-group d-inline-block col-9">
        <input type="text" name="s" class="form-control" placeholder="Search" value="{{Request::get('s')}}" />
      </div>
      <button type="submit" class="btn btn-outline-danger d-inline">Search</button>
    </form>
  </div>
  <div class="clearfix d-none d-md-block pt-4 pt-lg-0">
    <div class="float-start col-7">
      <h2 class="f-3 fw-bold">Discover a World of Available EBooks</h2>
      <p class="f-6">Explore our collection and choose a book that satisfies your reading cravings. You will get the ebook download link.</p>
    </div>
    <span class="dropdown">
        <button class="btn btn-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-arrow-right-arrow-left"></i>
        </button>
        <ul class="dropdown-menu">
          <li><a href="{{ route('public.ebook.asc') }}" class="dropdown-item" type="button">Ascending</a></li>
          <li><a href="{{ route('public.ebook.desc') }}" class="dropdown-item" type="button">Descending</a></li>
        </ul>
      </span>
    <form action="{{ route('public.ebook') }}" method="GET" class="float-end">
      <div class="form-group d-inline-block">
        <input type="text" name="s" class="form-control" placeholder="Search" value="{{Request::get('s')}}" />
      </div>
      <button type="submit" class="btn btn-outline-danger d-inline">Search</button>
    </form>
  </div>
  <div class="my-3 row">
    @foreach ($ebooks as $ebook)
    <a href="{{ route('public.ebook_detail', $ebook->id) }}" class="col-6 col-sm-4 col-md-3 col-lg-2 mb-2">
        <div class="card shadow-sm bg-body-secondary">
          <div class="card-body book-card">
            <img src="{{$ebook->cover}}" alt="book-cover" class="book-cover rounded-top-2 d-block mx-auto mb-1">
            <h2 class="f-6 fw-bold">{{$ebook->title}}</h2>
            <p class="f-s mb-1">
              @foreach ($ebook->author as $author)
              {{$author->name}}/
              @endforeach
            </p>
            @foreach ($ebook->category as $category)
            <span class="bg-info px-1 rounded-1 f-s">{{$category->name}}</span>
            @endforeach
            <p class="f-s mt-1">
              <i class="fa-solid fa-calendar-days"></i> : {{$ebook->date}}
            </p>
            <p class="f-s mt-1">
              <i class="fa-solid fa-hand-holding-dollar"></i> : {{$ebook->price}}MMK
            </p>
          </div>
        </div>
      @endforeach
  </div>
</div>
@endsection
