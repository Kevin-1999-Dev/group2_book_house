@extends('layouts.master')

@section('title')
User Dashboard Page
@endsection
@section('content')
<section class="sec-branch f-3">
    <div class="">
        <div class="bg-image"></div>
        <div class="content text-center">
            <h2>Hello <span class="text-uppercase text-danger">{{ Auth::user()->name }}</span></h2>
            <h3 class=""><i>Welcome From <span class="text-decoration-underline">Book House</span></i></h3>
        </div>
    </div>
</section>
<section class="sec-what py-5 f-6 ">
    <div class="container">
        <h2 class="text-center text-white f-3">What can you do?</h2>
        <div class="row mt-5 box-one">
            <div class="col-6 pt-3 text">
                <h4 class="fw-bold text-white f-4"><i>Buy books And ebooks</i></h4>
                <p class="text-white-50 mt-3">We have different kinds of categories for <span class="text-warning">Book</span> and <span class="text-warning">Ebook</span> <br>such as
                    <span class="text-warning">Anime, Manga, Drama, Comedy, <br class="sp">Adventure, Horror, Sport, <br class="tb">Family, Life, Romance, Education<br></span> and so on. So, you can chooes
                    what ever make you satisfy.</p>
                <p class="text-warning f-3 fw-bold mt-5">We hope you enjoy it.</p>
                <a href="{{ route('public.book') }}" class="btn btn-sm btn-success w-50 mt-2">Wanna Try?</a>
            </div>
            <div class="col-6">
                <img src="{{ asset('images/img_buybook.jpg') }}" alt="buy books and ebooks" class="w-100 rounded">
            </div>
        </div>
        <div class="row mt-5 box-two">
            <div class="col-6">
                <img src="{{ asset('images/img_manage.webp') }}" alt="buy books and ebooks" class="w-100 rounded">
            </div>
            <div class="manage col-6 text">
                <h4 class="fw-bold text-white f-4"><i>Manage Your Accout</i></h4>
                <p class="text-white-50 mt-3">You can change your name , email , image , address , Pphone and password, but <span class="text-warning">you can not change your role</span>
                </p>
                <p class="text-warning f-3 fw-bold mt-5">We hope you understand it.</p>
                <a href="{{ route('user.details') }}" class="btn btn-sm btn-success w-50 text-white mt-2"><i>More...</i></a>
            </div>
        </div>
    </div>
</section>
@endsection
