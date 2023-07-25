@extends('layouts.master')
@section('title')
Create Book
@endsection
@section('content')
<div class="create-pg col-11 col-md-10 col-lg-8 mx-auto pb-5">
    <div class="card">
        <div class="card-header">
            <h3 class="f-3">Create Book</h3>
        </div>
        <div class="card-body f-7">
            <form action="{{ route('admin.book.store')}}" method="post" class="px-lg-4" enctype='multipart/form-data'>
                @csrf
                <div class="form-group m-3">
                    <label for="title">Title<span class=text-danger>*</span></label>
                    <input type="text" class="form-control" name="title" value="{{(old('title'))}}">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group m-3">
                    <label for="cover">Cover<span class=text-danger>*</span></label>
                    <input type="file" class="form-control" name="cover" value="{{(old('cover'))}}" required>
                    @error('cover')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group m-3">
                    <label for="description">Description<span class=text-danger>*</span></label>
                    <textarea class="form-control" name="description" rows="3">{{(old('description'))}}</textarea>
                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group m-3">
                    <label for="pagecount">Page Count<span class=text-danger>*</span></label>
                    <input type="text" class="form-control" name="pagecount" value="{{(old('pagecount'))}}">
                    @error('pagecount')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group m-3">
                    <label for="price">Price<span class=text-danger>*</span></label>
                    <input type="text" class="form-control" name="price" value="{{(old('price'))}}">
                    @error('price')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group m-3">
                    <label for="categories[]">Categories<span class=text-danger>*</span></label>
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
                    <label for="authors[]">Authors<span class=text-danger>*</span></label>
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
                    <a href="{{ url()->previous() }}"><span class="btn btn-secondary float-start">Back</span></a>
                    <input type="submit" class="btn btn-primary float-end" value="Create">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('.multiple-select-field').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        closeOnSelect: false,
    });
</script>
@endsection
