@extends('layouts.master')
@section('title')
Ebook Details Page
@endsection
@section('content')
<div class="detail col-11 col-md-8 mx-auto d-flex align-items-center mt-4 mt-md-0">
  <div class="card bg-body-secondary">
    <h4 class="card-header font-weight-bold shadow-sm border-bottom border-info-subtle f-4">"{{$ebook->title}}", the book Detail</h4>
    <div class="row p-3 d-flex align-items-center">
      <div class="col-5 col-md-4 rounded-2">
        <img src="{{$ebook->cover}}" alt="book-cover" class="book rounded-2">
      </div>
      <div class="col-sm-12 col-md-8 mt-2 mt-md-0">
        <h5 class="f-4 mb-1">Title : <span class="f-3">{{$ebook->title}}</span></h5>
        <p class="f-4 mb-1">Author :
          @foreach ($ebook->author as $author)
          {{$author->name}}/
          @endforeach
        </p>
        <p class="f-4 mb-1">
          Category :
          @foreach ($ebook->category as $category)
          <span class="bg-info px-1 rounded-1 fs-6">{{$category->name}}</span>
          @endforeach
        </p>
        <p class="f-4 mb-1">
          Date added : {{$ebook->date}}
        </p>
        <p class="f-4 mb-1">
          Price : {{$ebook->price}}MMK
        </p>
        <h5 class="f-4">Description :</h5>
        <p class="f-6">&nbsp;&nbsp;&nbsp;&nbsp;{{$ebook->description}}</p>
        <button class="btn btn-dark btn-sm col-4 mt-2" id="addToCartBtn">Add to Cart</button>
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
      .then(function() {
        updateTotalItem();
      })
  });
</script>
@endsection