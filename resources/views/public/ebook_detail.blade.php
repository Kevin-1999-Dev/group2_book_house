@extends('layouts.master')
@section('title')
    Ebook Details Page
@endsection
@section('content')
<div class="detail col-sm-8 col-lg-6 mx-auto d-flex align-items-center">
  <div class="card bg-body-secondary">
    <h4 class="card-header font-weight-bold shadow-sm border-bottom border-info-subtle">{{$ebook->title}}, the book Detail</h4>
    <div class="row p-3 d-flex align-items-center">
      <div class="col-4 rounded-2">
      <img src="{{$ebook->cover}}" alt="book-cover" class="book rounded-2">
      </div>
      <div class="col-sm-12 col-md-8 mt-2 mt-md-0">
        <h5 class="fs-5 m-0">Title : <span class="fs-4">{{$ebook->title}}</span></h5>
        <p class="fs-5 m-0">Author :
          @foreach ($ebook->author as $author)
          {{$author->name}}
          @endforeach
        </p>
        <p class="fs-5 m-0">
        Category :
        @foreach ($ebook->category as $category)
          <span class="bg-info px-1 rounded-1 fs-6">{{$category->name}}</span>
          @endforeach
        </p>
        <p class="fs-5 m-0">
          Date added : {{$ebook->date}}
        </p>
        <p class="fs-5 m-0">
          Price : {{$ebook->price}}MMK
        </p>
        <h5 class="m-0">Description:</h5>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;{{$ebook->description}}</p>
        <button class="btn btn-dark btn-sm col-6" id="addToCartBtn">Add to Cart</button>
      </div>

    </div>
  </div>
</div>
<script>
  function updateTotalItem() {
    axios.get("{{route('public.cart.info')}}")
      .then(function(response) {
        document.getElementById('totalItem').innerHTML = response.data['totalItem'];
      })
  }
  var addToCartBtn = document.getElementById('addToCartBtn');
  addToCartBtn.addEventListener('click', function() {
    axios.get("{{route('public.cart.addebook',$ebook->id)}}")
      .then(function(){
        updateTotalItem();
      })
  });
</script>
@endsection
