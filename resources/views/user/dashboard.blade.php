@extends('user.layouts.master')

@section('title')
    Home Page
@endsection

@section('content')
    <section class="sec-branch">
        <div class="container">
            <div class="content text-center">
                <h2>Hello <span class="text-uppercase text-danger">{{ Auth::user()->name }}</span></h2>
                <h3 class="text-muted"><i>Welcome From BookHouse</i></h3>
            </div>
        </div>
    </section>
    <section class="sec-about">
        <div class="container">
          
        </div>
    </section>
@endsection
