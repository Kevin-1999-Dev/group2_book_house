@extends('layouts.master')

@section('content')
<div class="detail col-sm-8 col-lg-6 mx-auto my-5 d-flex align-items-center">
  <div class="card bg-body-secondary">
    <h4 class="card-header font-weight-bold shadow-sm border-bottom border-info-subtle">{{$book->title}}, the book Detail</h4>
    <div class="row p-3 d-flex align-items-center">
      <div class="col-4 rounded-2">
      <img src="{{$book->cover}}" alt="book-cover" class="book rounded-2">
      </div>
      <div class="col-sm-12 col-md-8 mt-2 mt-md-0">
        <h5 class="fs-5 m-0">Title : <span class="fs-4">{{$book->title}}</span></h5>
        <p class="fs-5 m-0">Author : 
          @foreach ($book->author as $author)
          {{$author->name}}
          @endforeach
        </p>
        <p class="fs-5 m-0">
        Category : 
        @foreach ($book->category as $category)
          <span class="bg-info px-1 rounded-2 fs-6">{{$category->name}}</span>
          @endforeach
        </p>
        <p class="fs-5 m-0">
          Date added : {{$book->date}}
        </p>
        <p class="fs-5 m-0">
          Price 
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">
            <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z" />
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
          </svg> : {{$book->price}}MMK
        </p>
        <h5 class="m-0">Description:</h5>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;{{$book->description}}</p>
        <button class="btn btn-success btn-sm col-6" type="button">Add to Cart</button>
      </div>

    </div>
  </div>
</div>
@endsection