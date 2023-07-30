@extends('layouts.master')
@section('title')
Reset Password
@endsection
@section('content')
    <div class="container-fluid">
        <div class="cmn-inner row py-3 py-lg-5">
            <a href="{{ route('public.index') }}" class="col-11 col-md-8 mx-auto f-5"> <i
                    class="fa-sharp fa-solid fa-arrow-left"></i>
                <h5 class="d-inline">Return Home Page</h5>
            </a>
            <div class="col-11 col-md-8 col-lg-6 mx-auto mt-2 mt-lg-5">
                <img class="col-2 d-block mx-auto mb-2 mb-lg-4" src="{{ asset('images/img_bookhouse_logo.png') }}"
                    alt="">
                <form action="{{ route('password.update') }}" method="POST"
                    class="shadow-lg p-3 p-md-5 border rounded">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="form-group mt-3">
                        <label for="email" class="form-label">Email</label>
                        <span class="text-danger">*</span>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                        @error('email')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                    <div class="form-group mt-3 f-6">
                        <label for="password" class="form-label">Password</label>
                        <span class="text-danger">*</span>
                        <input type="password" name="password" class="form-control" required
                            autocomplete="new-password">
                        @error('password')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>

                    <div class="form-group mt-3 f-6">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <span class="text-danger">*</span>
                        <input type="password" name="password_confirmation" class="form-control" required
                            autocomplete="new-password">
                        @error('password_confirmation')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                    <div>
                        <input type="submit" value="{{ __('Reset Password') }}"
                            class="btn btn-sm btn-primary w-100 mt-3">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
