@extends('layouts.master')

@section('title')
Change Password Page
@endsection
@section('content')
<div class="change-password">
    <div class="col-11 col-md-10 mx-auto mb-2">
        <a href="{{ url()->previous() }}">
            <i class="fa-solid fa-arrow-left-long"></i> <span class="f-4">Back</span>
        </a>
    </div>
    <div class="col-11 col-md-6 mx-auto">
        <form action="{{ route('user.changePassword',Auth::user()->id) }}" method="POST" class="shadow-lg px-5 py-3 border rounded border-dark-subtle">
            @csrf
            <h2 class="text-center f-3"><span class="border-bottom border-danger-subtle">Change Password</span></h2>
            <div class="form-group mt-3 f-7">
                <label for="" class="form-label">Old Password</label>
                <span class="text-danger">*</span>
                <input type="password" name="oldPassword" class="form-control @if (session('notMatch')) is-invalid @endif  @error('oldPassword') is-invalid  @enderror" id="" placeholder="Enter Old Password...">
                @error('oldPassword')
                <i class="invalid-feedback">
                    {{ $message }}
                </i>
                @enderror
                @if (session('notMatch'))
                <i class="invalid-feedback">
                    {{ session('notMatch') }}
                </i>
                @endif
            </div>
            <div class="form-group mt-3 f-7">
                <label for="" class="form-label">New Password</label>
                <span class="text-danger">*</span>
                <input type="password" name="newPassword" class="form-control @error('newPassword') is-invalid  @enderror" id="" placeholder="Enter New Password...">
                @error('newPassword')
                <i class="invalid-feedback">
                    {{ $message }}
                </i>
                @enderror
            </div>
            <div class="form-group mt-3  f-7">
                <label for="" class="form-label">Confirm Password</label>
                <span class="text-danger">*</span>
                <input type="password" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid  @enderror" id="" placeholder="Enter Confirm Password...">
                @error('confirmPassword')
                <i class="invalid-feedback">
                    {{ $message }}
                </i>
                @enderror
            </div>
            <div class="mt-4 col-6 mx-auto">
                <input type="submit" value="Change" class="btn btn-primary w-100">
            </div>
        </form>
    </div>
</div>
@endsection
