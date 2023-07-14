@extends('layouts.master')
@section('title')
Create Payment
@endsection
@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h3>Create Payment</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.payment.store')}}" method="post" class="mt-4 p-4">
            @csrf
            <div class="form-group m-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{(old('name'))}}">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group m-3">
                <a href="{{ route('admin.payment.index')}}"><span class="btn btn-secondary float-left">Back</span></a>
                <input type="submit" class="btn btn-primary float-right" value="Create">
            </div>
        </form>
    </div>
</div>
@endsection
