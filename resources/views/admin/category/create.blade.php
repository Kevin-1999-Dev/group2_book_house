@extends('layouts.master')
@section('title')
Create Category
@endsection
@section('content')
<div class="create-pg col-11 col-md-10 col-lg-8 mx-auto pb-5">
    <div class="card">
        <div class="card-header">
            <h3 class="f-3">Create Category</h3>
        </div>
        <div class="card-body f-7">
            <form action="{{ route('admin.category.store')}}" method="post" class="px-lg-4">
                @csrf
                <div class="form-group m-3">
                    <label for="name">Name<span class=text-danger>*</span></label>
                    <input type="text" class="form-control" name="name" value="{{(old('name'))}}">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group m-3">
                    <a href="{{ url()->previous() }}"><span class="btn btn-secondary float-start">Back</span></a>
                    <input type="submit" class="btn btn-primary float-end" value="Create">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
