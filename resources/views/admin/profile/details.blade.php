@extends('layouts.master')
@section('title')
Account Info Page
@endsection
@section('content')
<div class="profile-pg py-5">
    <div class="col-11 col-md-10 col-lg-6 mx-auto bg-light row p-3 rounded-2 border border-danger-subtle">
        <h2 class="text-center f-3"><span class="border-bottom border-danger-subtle">Your Account Informartion</span></h2>
        <div class="mt-5 row">
            <div class="col-5">
                @if (Auth::user()->image == null)
                <img src="{{ asset('images/default.png') }}" alt="" srcset="" class="w-75 img-thumbnail">
                @else
                <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="" srcset="" class="w-100 img-thumbnail">
                @endif
            </div>
            <div class="col-7 f-7 ps-5">
                <h5> Name - <i class="text-danger">{{Auth::user()->name}}</i></h5>
                <h5> Email - <i class="text-danger">{{Auth::user()->email}}</i></h5>
                <h5> Phone - <i class="text-danger">{{Auth::user()->phone}}</i></h5>
                <h5> Address - <i class="text-danger">{{Auth::user()->address}}</i></h5>
                <h5> Created At - <i class="text-danger">{{Auth::user()->created_at->format('j-F-Y')}}</i></h5>
            </div>
        </div>
        <div class="my-3">
            <a href="{{ route('admin.editPage') }}" class="btn btn-sm btn-dark w-25 col-4 offset-6">Edit</a>
        </div>
    </div>
</div>
@endsection
