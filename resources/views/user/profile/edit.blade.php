@extends('layouts.master')

@section('title')
Account Edit Page
@endsection
@section('content')
<div class="profile-edit pb-5">
    <div class="col-11 col-md-10 mx-auto bg-light row py-3 px-lg-3 rounded-2 border border-danger-subtle">
        <div class="text-center">
            <h2 class="f-3">Your Profile</h2>
            @if (Auth::user()->role == 1)
            <h4 class="text-danger f-4">( Role - Admin )</h4>
            @else
            <h4 class="text-danger f-4">( Role - User )</h4>
            @endif
        </div>
        <div class="my-2 f-7">
            <form action="{{ route('user.updateUser', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-4 col-md-6 px-md-3 pt-2">
                        <div class="col-md-8 col-lg-6 float-end">
                            @if (Auth::user()->image == null)
                            <img src="{{ asset('images/default.png') }}" alt="" srcset="" class="w-100 img-thumbnail">
                            @else
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="" srcset="" class="w-100 img-thumbnail">
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
                    </div>
                    <div class="col-8 col-md-6">
                        <div class="col-lg-10">
                            <div class="form-group mb-3">
                                <label for="" class="">Name</label>
                                <input type="text" name="name" id="" value="{{ old('name', Auth::user()->name) }}" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="">Email</label>
                                <input type="email" name="email" id="" value="{{ old('email', Auth::user()->email) }}" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="">Phone</label>
                                <input type="number" name="phone" id="" value="{{ old('phone', Auth::user()->phone) }}" class="form-control @error('phone') is-invalid @enderror">
                                @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="">Address</label>
                                <input type="text" name="address" id="" value="{{ old('address', Auth::user()->address) }}" class="form-control @error('address') is-invalid @enderror">
                                @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Update" class="btn btn-sm btn-dark w-25 float-end">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
