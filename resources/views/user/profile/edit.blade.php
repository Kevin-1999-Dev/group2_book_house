@extends('layouts.master')

@section('title')
    Account Edit Page
@endsection

@section('content')
    <div class="card mt-5">
        <div class="card-header text-center">
            <h2>Your Profile</h2>
            @if (Auth::user()->role == 1)
                <h4 class="text-danger">( Role - Admin )</h4>
            @else
                <h4 class="text-danger">( Role - User )</h4>
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('user.updateUser', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row p-3">
                    <div class="col-3 offset-3">
                        @if (Auth::user()->image == null)
                            <img src="{{ asset('images/default.png') }}" alt="" srcset=""
                                class="w-100 img-thumbnail">
                        @else
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="" srcset=""
                                class="w-100 img-thumbnail">
                        @endif
                        <div class="form-group mt-2">
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="" class="">Name</label>
                            <input type="text" name="name" id="" value="{{ old('name', Auth::user()->name) }}"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group my-3">
                            <label for="">Email</label>
                            <input type="email" name="email" id=""
                                value="{{ old('email', Auth::user()->email) }}"
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group my-3">
                            <label for="">Phone</label>
                            <input type="number" name="phone" id=""
                                value="{{ old('phone', Auth::user()->phone) }}"
                                class="form-control @error('phone') is-invalid @enderror">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group my-3">
                            <label for="">Address</label>
                            <input type="text" name="address" id=""
                                value="{{ old('address', Auth::user()->address) }}"
                                class="form-control @error('address') is-invalid @enderror">
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update" class="btn btn-dark w-25 float-end">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
