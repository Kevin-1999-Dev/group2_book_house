@extends('layouts.master')
@section('title')
Edit Book
@endsection
@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h3>Edit Book</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.book.update',$book->id)}}" method="post" class="mt-4 p-4" enctype='multipart/form-data'>
            @csrf
            <div class="form-group m-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="{{(old('_token') !== null) ? old('title') : $book->title}}">
                @error('title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group m-3">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" rows="3">{{(old('_token') !== null) ? old('description') : $book->description}}</textarea>
                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group m-3">
                <label for="pagecount">Page Count</label>
                <input type="text" class="form-control" name="pagecount" value="{{(old('_token') !== null) ? old('pagecount') : $book->pagecount}}">
                @error('pagecount')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group m-3">
                <label for="price">Price</label>
                <input type="text" class="form-control" name="price" value="{{(old('_token') !== null) ? old('price') : $book->price}}">
                @error('price')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group m-3">
                <label for="categories[]">Categories</label>
                <select name="categories[]" class="form-control form-select multiple-select-field" multiple>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ (old('_token') !== null) ? (collect(old('categories'))->contains($category->id) ? 'selected' : '') : (collect($book->category->pluck('id')->all())->contains($category->id) ? 'selected' : '')}}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                @error('categories')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group m-3">
                <label for="authors[]">Authors</label>
                <select name="authors[]" class="form-control form-select multiple-select-field" multiple>
                    @foreach ($authors as $author)
                    <option value="{{ $category->id }}" {{ (old('_token') !== null) ? (collect(old('authors'))->contains($author->id) ? 'selected' : '') : (collect($book->author->pluck('id')->all())->contains($author->id) ? 'selected' : '')}}>
                        {{ $author->name }}
                    </option>
                    @endforeach
                </select>
                @error('authors')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group m-3">
                <a href="{{ route('admin.book.index')}}"><span class="btn btn-secondary float-start">Back</span></a>
                <input type="submit" class="btn btn-primary float-end" value="Create">
            </div>
        </form>
    </div>
</div>
<script>
    $('.multiple-select-field').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        closeOnSelect: false,
    });
</script>
@endsection
