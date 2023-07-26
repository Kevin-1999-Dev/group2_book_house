@extends('layouts.master')
@section('title')
Forget Password
@endsection
@section('content')
<div class="create-pg col-11 col-md-10 col-lg-8 mx-auto pb-5">
    <a href="{{ route('public.index') }}" class="col-11 col-md-8 mx-auto f-5"> <i class="fa-sharp fa-solid fa-arrow-left"></i>
        <h5 class="d-inline">Return Home Page</h5>
    </a>
    <div class="col-11 col-md-8 col-lg-6 mx-auto mt-2 mt-lg-5">
        <img class="col-2 d-block mx-auto mb-2 mb-lg-4" src="{{ asset('images/img_bookhouse_logo.png') }}" alt="">
        <div class="text-center">
            @if(session('status') == 'success')
            <div class="alert alert-success fade show" role="alert">
                Password Reset Email sent successfully.
            </div>
            @elseif(session('status') == 'failed')
            <div class="alert alert-danger fade show" role="alert">
                Cannot Send Email
            </div>
            @elseif(session('status') == 'not-found')
            <div class="alert alert-danger fade show" role="alert">
                Email Not Found
            </div>
            @endif
        </div>

        <form action="{{ route('auth.processForgetPassword') }}" method="POST" class="shadow-lg p-3 p-md-5 border rounded">
            @csrf
            <h2 class="text-center f-3 w-10">Forget Password</h2>
            <div class="form-group mt-3 f-6">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <span class="text-danger">*</span>
                <input id="email" class="form-control block" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>
            <div class="text-center">
                <input type="submit" value="{{ __('Email Password Reset Link') }}" class="btn btn-sm btn-primary w-50 mt-3">
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
    $(".alert").delay(3000).slideUp(200, function() {
        $(this).alert('close');
    });
</script>

@endsection
