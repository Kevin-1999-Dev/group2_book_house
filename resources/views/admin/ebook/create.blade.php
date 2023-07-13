@extends('layouts.master')
@section('title')
Create Ebook
@endsection
@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h3>Create Ebook</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.ebook.store')}}" method="post" class="mt-4 p-4" enctype='multipart/form-data'>
            @csrf
            <div class="form-group m-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="{{(old('title'))}}">
                @error('title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group m-3">
                <label for="cover">Cover</label>
                <input type="file" class="form-control" name="cover" value="{{(old('cover'))}}">
                @error('cover')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group m-3">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" rows="3">{{(old('description'))}}</textarea>
                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group m-3">
                <label for="pagecount">Page Count</label>
                <input type="text" class="form-control" name="pagecount" value="{{(old('pagecount'))}}">
                @error('pagecount')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group m-3">
                <label for="price">Price</label>
                <input type="text" class="form-control" name="price" value="{{(old('price'))}}">
                @error('price')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group m-3">
                <label for="link">Link</label>
                <input type="text" class="form-control" name="link" value="{{(old('link'))}}">
                @error('link')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group m-3">
                <label for="categories[]">Categories</label>
                <select name="categories[]" class="form-control form-select multiple-select-field" multiple>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ collect(old('categories'))->contains($category->id) ? 'selected' : '' }}>
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
                    <option value="{{ $author->id }}" {{ collect(old('authors'))->contains($author->id) ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                    @endforeach
                </select>
                @error('authors')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group m-3">
                <a href="{{ route('admin.ebook.index')}}"><span class="btn btn-secondary float-left">Back</span></a>
                <input type="submit" class="btn btn-primary float-right" value="Create">
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
