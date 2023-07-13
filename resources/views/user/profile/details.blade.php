@extends('layouts.master')

@section('title')
    Account Info Page
@endsection

@section('content')
    <div class="bg-light row mt-5 p-3 rounded">
        <h2 class="text-center">Your Account Informartion</h2>
        <div class="mt-5 row">
            <div class="col-4 offset-3  text-center">
               @if (Auth::user()->image == null)
               <img src="{{ asset('images/default.png') }}" alt="" srcset="" class="w-50 img-thumbnail">
               @else
               <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="" srcset="" class="w-75 img-thumbnail">
               @endif
            </div>
            <div class="col-4">
               <h5> Name - <i class="text-danger">{{Auth::user()->name}}</i></h5>
               <h5> Email - <i class="text-danger">{{Auth::user()->email}}</i></h5>
               <h5> Phone - <i class="text-danger">{{Auth::user()->phone}}</i></h5>
               <h5> Address - <i class="text-danger">{{Auth::user()->address}}</i></h5>
               <h5> Created At - <i class="text-danger">{{Auth::user()->created_at->format('j-F-Y')}}</i></h5>
            </div>
        </div>
        <div class="my-3">
            <a href="{{ route('user.editPage') }}" class="btn btn-dark w-25 col-4 offset-7">Edit</a>
        </div>
    </div>
@endsection
