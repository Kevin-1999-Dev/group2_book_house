@extends('layouts.master')
@section('title')
Book List
@endsection
@section('content')
<a href="{{ route('admin.book.create')}}"><span class="btn btn-primary mt-5">Create</span></a>
<div class="float-end mt-5">
    <a href="" class="btn btn-dark text-white">Import</a>
    <a href="" class="btn btn-dark text-white">Export</a>
</div>
<div class="row mt-3">
    <div class="col-12 align-self-center">
        <div class="card">
            <div class="card-header">
                <h3 class="float-start">Books List</h3>
                <div class="float-end">
                    <form action="{{ route('admin.book.index') }}" method="GET">
                        <div class="form-group d-inline-block">
                            <input type="text" name="s" class="form-control" placeholder="Search" value="{{Request::get('s')}}" />
                        </div>
                        <button type="submit" class="btn btn-outline-primary d-inline">Search</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
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
                                <a href="{{route('admin.book.edit',$book->id)}}"><span class="btn btn-success">Edit</span></a>
                                <a href="{{route('admin.book.delete',$book->id)}}" onclick="return confirm('Are you sure?')"><span class="btn btn-danger">Delete</span></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
