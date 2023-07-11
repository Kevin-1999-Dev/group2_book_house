@extends('user.layouts.master')

@section('title')
    User Dashboard Page
@endsection

@section('content')
    <section class="sec-branch">
        <div class="">
            <div class="bg-image"></div>
            <div class="content text-center">
                <h2>Hello <span class="text-uppercase text-danger">{{ Auth::user()->name }}</span></h2>
                <h3 class=""><i>Welcome From <span class="text-decoration-underline">BookHouse</span></i></h3>
            </div>
        </div>
    </section>
    <section class="sec-what py-5">
        <div class="container">
            <h2 class="text-center text-white">What Can You Do?</h2>
            <div class="row mt-5">
                <div class="col-6 pt-5">
                    <h4 class="fw-bold text-white "><i>Buy Books And Ebooks</i></h4>
                    <p class="text-white-50">We have many Category for <span class="text-warning">Book</span> and <span class="text-warning">Ebook</span> ,They are
                        Anime,Manga,Drama,Comedy,Adventure,Horror,Sport,Family,Life,Romance,Education and so on ,So You can chooes
                        What ever what u want </p>
                    <p class="text-warning fs-2 fw-bold mt-5">We Hope You will enjoy it </p>

                    <a href="{{ route('public.book') }}" class="btn btn-success w-50 p-2">Wanna Try?</a>
                </div>
                <div class="col-6">
                    <img src="{{ asset('images/img_buybook.jpg') }}" alt="buy books and ebooks" class="w-100 rounded">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-6">
                    <img src="{{ asset('images/img_manage.webp') }}" alt="buy books and ebooks" class="w-100 rounded">
                </div>
                <div class="manage col-6">
                    <h4 class="fw-bold text-white "><i>Manage Your Accout</i></h4>
                    <p class="text-white-50 mt-5">You can change Your Name , Email , Image , Address , Phone and Password , but <span class="text-warning">You can not change Your Role</span>
                       </p>
                    <p class="text-warning fs-2 fw-bold mt-5">We Hope You will understand it </p>

                    <a href="" class="text-decoration-none fs-3 text-dark p-2"><i>More...</i></a>
                </div>
            </div>
        </div>
    </section>
@endsection
