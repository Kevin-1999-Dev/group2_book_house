@extends('admin.layouts.master')

@section('tile')
    Admin Dashboard
@endsection

@section('content')
<section>
    <div class="pt-5">
        <div class="container text-center pt-5">
            <h2>Hello <span class="text-danger text-uppercase">{{ Auth::user()->name }} </span> </h2>
            <p>Welcome From Admin Dashboard</p>
           <div class="mt-5 row">
            <div class="col-5 shadow bg-body rounded p-2">
                <div class="my-3 w-100">
                    <a href="{{ route('admin.category.index') }}" class="text-decoration-none">
                        <button class="btn  btn-dark w-50"><i class="fa-solid fa-list-check"></i> Category</button>
                    </a>
                   </div>
                    <div class="my-3 w-100">
                        <a href="{{ route('admin.author.index') }}" class="text-decoration-none">
                            <button class="btn  btn-dark w-50"><i class="fa-solid fa-pen"></i> Author</button>
                        </a>
                    </div>
                    <div class="my-3 w-100">
                        <a href="" class="text-decoration-none">
                            <button class="btn  btn-dark w-50"><i class="fa-solid fa-book"></i> Book</button>
                        </a>
                    </div>
                    <div class="my-3 w-100">
                        <a href="" class="text-decoration-none">
                            <button class="btn  btn-dark w-50"><i class="fa-solid fa-book"></i> EBook</button>
                        </a>
                    </div>
            </div>
            <div class="col-2 pt-2">
                <img src="{{ asset('images/sign2.avif') }}" alt="" class="w-100">
            </div>
            <div class="col-5 shadow bg-body rounded p-2">
                <div class="my-3 w-100">
                    <a href="" class="text-decoration-none">
                        <button class="btn btn-dark w-50"><i class="fa-solid fa-users"></i> User List</button>
                    </a>
                </div>
                <div class="my-3 w-100">
                    <a href="" class="text-decoration-none">
                        <button class="btn  btn-dark w-50"><i class="fa-solid fa-cart-shopping"></i> Order List</button>
                    </a>
                </div>
                <div class="my-3 w-100">
                    <a href="" class="text-decoration-none">
                        <button class="btn  btn-dark w-50"><i class="fa-solid fa-money-bill-1-wave"></i> Payment</button>
                    </a>
                </div>
            </div>
           </div>
        </div>
    </div>
</section>
@endsection
