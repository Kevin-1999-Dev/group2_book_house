@extends('layouts.master')
@section('title')
Register
@endsection
@section('content')
<div class="create-pg col-11 col-md-10 col-lg-8 mx-auto pb-5">
    <a href="{{ route('public.index') }}" class="col-11 col-md-8 mx-auto f-5"> <i class="fa-sharp fa-solid fa-arrow-left"></i>
        <h5 class="d-inline">Return Home Page</h5>
    </a>
    <div class="col-11 col-md-8 col-lg-6 mx-auto mt-2">
        <img class="col-2 d-block mx-auto mb-2 mb-lg-4" src="{{ asset('images/img_bookhouse_logo.png') }}" alt="logo">
        <form action="{{ route('register') }}" method="POST" class="shadow-lg p-3 px-lg-5 border rounded">
            @csrf
            <h2 class="text-center f-3">Register Now</h2>
            <div class="form-group mt-3 f-6">
                <label for="" class="form-label">Name</label>
                <span class="text-danger">*</span>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="" placeholder="Name">
                @error('name')
                <i class="invalid-feedback">{{ $message }}</i>
                @enderror
            </div>
            <div class="form-group mt-3 f-6">
                <label for="" class="form-label">Email</label>
                <span class="text-danger">*</span>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="" placeholder="example@gmail.com">
                @error('email')
                <i class="invalid-feedback">{{ $message }}</i>
                @enderror
            </div>
            <div class="form-group mt-3 f-6">
                <label for="" class="form-label">Phone</label>
                <span class="text-danger">*</span>
                <input type="number" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" id="" placeholder="09*********">
                @error('phone')
                <i class="invalid-feedback">{{ $message }}</i>
                @enderror
            </div>
            <div class="form-group mt-3 f-6">
                <label for="" class="form-label">Address</label>
                <span class="text-danger">*</span>
                <input type="text" name="address" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror" id="" placeholder="Address">
                @error('address')
                <i class="invalid-feedback">{{ $message }}</i>
                @enderror
            </div>
            <div class="form-group mt-3 f-6">
                <label for="" class="form-label">Password</label>
                <span class="text-danger">*</span>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="" placeholder="Password">
                @error('password')
                <i class="invalid-feedback">{{ $message }}</i>
                @enderror
            </div>
            <div class="form-group mt-3 f-6">
                <label for="" class="form-label">Confirm Password</label>
                <span class="text-danger">*</span>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="" placeholder="Confirm Password">
                @error('password_confirmation')
                <i class="invalid-feedback">{{ $message }}</i>
                @enderror
            </div>
            <div class="mt-4 text-center">
                <input type="submit" value="Register" class="btn btn-primary w-50">
            </div>
            <p class="mt-2 mt-lg-3 text-center f-7">Already Have An Account? <a href="{{ route('auth.loginPage') }}" class="text-decoration-none text-primary">Sign
                    In</a></p>
        </form>
    </div>
</div>
@endsection
