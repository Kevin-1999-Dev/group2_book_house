@extends('admin.layouts.master')

@section('title')
    Change Password Page
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-6 offset-3">
            <form action="{{ route('admin.changePassword') }}" method="POST" class="shadow-lg p-4 border rounded">
                @csrf
                <h2 class="text-center">Change Password</h2>
                <div class="form-group mt-3">
                    <label for="" class="form-label">Old Password</label>
                    <input type="password" name="oldPassword"
                        class="form-control  @error('oldPassword') is-invalid  @enderror"
                        id="" placeholder="Enter Old Password...">
                    @error('oldPassword')
                        <i class="invalid-feedback">
                            {{ $message }}
                        </i>
                    @enderror
                    {{-- @if (session('notMatch'))
                        <i class="invalid-feedback">
                            {{ session('notMatch') }}
                        </i>
                    @endif --}}
                </div>
                <div class="form-group mt-3">
                    <label for="" class="form-label">New Password</label>
                    <input type="password" name="newPassword"
                        class="form-control @error('newPassword') is-invalid  @enderror" id=""
                        placeholder="Enter New Password...">
                    @error('newPassword')
                        <i class="invalid-feedback">
                            {{ $message }}
                        </i>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="" class="form-label">Confirm Password</label>
                    <input type="password" name="confirmPassword"
                        class="form-control @error('confirmPassword') is-invalid  @enderror" id=""
                        placeholder="Enter Confirm Password...">
                    @error('confirmPassword')
                        <i class="invalid-feedback">
                            {{ $message }}
                        </i>
                    @enderror
                </div>
                <div class="mt-4">
                    <input type="submit" value="Change" class="btn btn-primary w-100">
                </div>
            </form>
        </div>
    </div>
@endsection
