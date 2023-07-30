@extends('layouts.master')
@section('title')
Login
@endsection
@section('content')
<div class="create-pg col-11 col-md-10 col-lg-8 mx-auto pb-5">
    <a href="{{ route('public.index') }}" class="col-11 col-md-8 mx-auto f-5"> <i class="fa-sharp fa-solid fa-arrow-left"></i>
        <h5 class="d-inline">Return Home Page</h5>
    </a>
    <div class="col-11 col-md-8 col-lg-6 mx-auto mt-2 mt-lg-5">
        <img class="col-2 d-block mx-auto mb-2 mb-lg-4" src="{{ asset('images/img_bookhouse_logo.png') }}" alt="login-logo">
        <form action="{{ route('login') }}" method="POST" class="shadow-lg p-3 p-md-5 border rounded">
            @csrf
            @if (session('successPwChange'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check"></i> {{ session('successPwChange') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('not'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check"></i> {{ session('not') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <h2 class="text-center f-3">Login</h2>
            <div class="form-group mt-3 f-6">
                <label for="" class="form-label">Email</label>
                <span class="text-danger">*</span>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="" value="{{ old('email') }}" placeholder="Enter Your Email...">
                @error('email')
                <i class="invalid-feedback">{{ $message }}</i>
                @enderror
            </div>
            <div class="form-group mt-3 f-6">
                <label for="" class="form-label">Password</label>
                <span class="text-danger">*</span>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="" placeholder="Enter Your Password...">
                @error('password')
                <i class="invalid-feedback">{{ $message }}</i>
                @enderror
            </div>
            <p class="mt-2 my-lg-3"><a href="{{ route('auth.forgetPasswordPage') }}" class="text-primary f-7">Forget Password?</a></p>
            <div class="mt-2 text-center">
                <input type="submit" value="Login" class="btn btn-sm btn-primary w-50">
            </div>
            <p class="mt-3 text-center f-7"> Don't Have An Account? <a href="{{ route('auth.registerPage') }}" class="text-decoration-none text-primary">Sign Up</a></p>
        </form>
    </div>
</div>
@endsection
