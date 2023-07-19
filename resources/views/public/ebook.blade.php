@extends('layouts.master')
@section('title')
    Ebook Page
@endsection
@section('content')
<div class="container-fluid mt-2 px-lg-5 ebook-pg">
<form action="{{ route('public.ebook') }}" method="GET" class="float-end">
      <div class="form-group d-inline-block">
        <input type="text" name="s" class="form-control" placeholder="Search" value="{{Request::get('s')}}" />
      </div>
      <button type="submit" class="btn btn-outline-primary d-inline">Search</button>
    </form>
      <h2>Discover a World of Available EBooks</h2>
      <p>Explore our collection and choose a book that satisfies your reading cravings. You will get the ebook download link.</p>
      <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-3">
        @foreach ($ebooks as $ebook)
        <a href="{{ route('public.ebook_detail', $ebook->id) }}">
            <div class="col">
              <div class="card shadow-sm bg-body-secondary">
                <div class="card-body book-card">
                  <img src="{{$ebook->cover}}" alt="book-cover" class="book-cover rounded-top-2 d-block mx-auto">
                  <h2 class="fs-5">{{$ebook->title}}</h2>
                  <p class="m-0">
                    @foreach ($ebook->author as $author)
                    {{$author->name}}<br>
                    @endforeach
                    @foreach ($ebook->category as $category)
                    <span class="bg-info px-1 rounded-1">{{$category->name}}</span><br>
                    @endforeach
                    <i class="fa-solid fa-calendar-days"></i>
                <span class="up-date">: {{$ebook->date}}</span><br>
                <i class="fa-solid fa-hand-holding-dollar"></i>
                <span class="price">: {{$ebook->price}}MMK</span>
              </p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
@endsection
