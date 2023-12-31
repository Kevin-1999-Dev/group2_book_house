@extends('layouts.master')
@section('title')
Book Detail Page
@endsection
@section('content')
<div class="detail col-11 col-md-8 mx-auto mt-5 mt-md-0">
    <div class="col-12 mb-2">
        <a href="{{ url()->previous() }}">
            <i class="fa-solid fa-arrow-left-long"></i> <span class="f-4">Back</span>
        </a>
    </div>
    <div class="card bg-body-secondary">
        <h4 class="card-header font-weight-bold shadow-sm border-bottom border-danger-subtle f-4">"{{$book->title}}", the book Detail</h4>
        <div class="row p-3 d-flex align-items-center">
            <div class="col-5 col-md-4 rounded-2 mx-auto">
                <img src="{{$book->cover}}" alt="book-cover" class="book rounded-2">
            </div>
            <div class="col-12 col-md-8 mt-2 mt-md-0 sm-detail">
                <h5 class="f-4 mb-1">Title : <span class="f-3">{{$book->title}}</span></h5>
                <p class="f-4 mb-1">Author :
                    @foreach ($book->author as $author)
                    {{$author->name}}
                    @if (!$loop->last)
                    /
                    @endif
                    @endforeach
                </p>
                <p class="f-4 mb-1">
                    Category :
                    @foreach ($book->category as $category)
                    <span class="bg-danger-subtle px-1 rounded-1 f-6">{{$category->name}}</span>
                    @endforeach
                </p>
                <p class="f-4 mb-1">
                    Date added : {{$book->date}}
                </p>
                <p class="f-4 mb-1">
                    Price : {{$book->price}}MMK
                </p>
                <h5 class="f-4">Description :</h5>
                <p class="f-6">&nbsp;&nbsp;&nbsp;&nbsp;{{$book->description}}</p>
                <button class="btn btn-dark btn-sm col-4 mt-2" id="addToCartBtn"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
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
        axios.get("{{route('public.cart.addbook',$book->id)}}")
            .then(function() {
                updateTotalItem();
            })
    });
</script>
@endsection
