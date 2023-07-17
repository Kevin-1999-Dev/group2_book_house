@extends('layouts.master')
@section('title')
Edit Category
@endsection
@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h3>Edit Category</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.category.update',$category->id)}}" method="post" class="p-4">
            @csrf
            <div class="form-group m-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{(old('_token') !== null) ? old('name') : $category->name}}">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group m-3">
                <a href="{{ route('admin.category.index')}}"><span class="btn btn-secondary float-start">Back</span></a>
                <input type="submit" class="btn btn-primary float-end" value="Submit">
            </div>
        </form>
    </div>
</div>
@endsection
