@extends('layouts.master')
@section('title')
Book List
@endsection
@section('content')
<div class="auth-book col-12 col-md-10 mx-auto pb-5">
    <div class="col-12">
        <a href="{{ route('admin.dashboard') }}">
            <i class="fa-solid fa-arrow-left-long"></i> <span class="f-4">Back</span>
        </a>
    </div>
    <div class="mt-4">
        <a href="{{ route('admin.book.create')}}"><span class="btn btn-primary">Create</span></a>
        <div class="float-end">
            <a href="" class="btn btn-dark text-white">Import</a>
            <a href="" class="btn btn-dark text-white">Export</a>
        </div>
    </div>
    <div class="mt-3">
        <div class="col-12 align-self-center">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-start f-3">Books List</h3>
                    <div class="float-end">
                        <form action="{{ route('admin.book.index') }}" method="GET">
                            <div class="form-group d-inline-block">
                                <input type="text" name="s" class="form-control" placeholder="Search" value="{{Request::get('s')}}" />
                            </div>
                            <button type="submit" class="btn btn-outline-danger d-inline">Search</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped f-7">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Category</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                            <tr>
                                <td>{{$book->title}}</td>
                                <td>
                                    @foreach($book->author as $author)
                                    <span>
                                        {{$author->name}}
                                        @if (!($loop->last))
                                        ,
                                        @endif
                                    </span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($book->category as $category)
                                    <span>
                                        {{$category->name}}
                                        @if (!($loop->last))
                                        ,
                                        @endif
                                    </span>
                                    @endforeach
                                </td>
                                <td>{{$book->price}} MMK</td>
                                <td>
                                    <a href="{{route('admin.book.edit',$book->id)}}"><span class="btn btn-sm btn-success">Edit</span></a>
                                    <a href="{{route('admin.book.delete',$book->id)}}" onclick="return confirm('Are you sure?')"><span class="btn btn-sm btn-danger">Delete</span></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
