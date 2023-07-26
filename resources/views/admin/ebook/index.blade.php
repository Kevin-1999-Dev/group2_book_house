@extends('layouts.master')
@section('title')
Ebook List
@endsection
@section('content')
<div class="auth-ebook col-11 col-md-10 mx-auto pb-5">
    <div class="col-12">
        <a href="{{ url()->previous() }}">
            <i class="fa-solid fa-arrow-left-long"></i> <span class="f-4">Back</span>
        </a>
    </div>
    <div class="mt-4">
        <a href="{{ route('admin.ebook.create')}}"><span class="btn btn-primary">Create</span></a>
        <div class="float-end">
            <a href="{{ route('admin.ebook.export') }}" class="btn btn-dark text-white">Export</a>
        </div>
    </div>
    <div class="mt-4">
        <div class="col-12 align-self-center d-none d-md-block">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-start f-3">Ebooks List</h3>
                    <div class="float-end">
                        <form action="{{ route('admin.ebook.index') }}" method="GET">
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
                            @foreach($ebooks as $ebook)
                            <tr>
                                <td>{{$ebook->title}}</td>
                                <td>
                                    @foreach($ebook->author as $author)
                                    <span>
                                        {{$author->name}}
                                        @if (!($loop->last))
                                        ,
                                        @endif
                                    </span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($ebook->category as $category)
                                    <span>
                                        {{$category->name}}
                                        @if (!($loop->last))
                                        ,
                                        @endif
                                    </span>
                                    @endforeach
                                </td>
                                <td>{{$ebook->price}} MMK</td>
                                <td>
                                    <a href="{{route('admin.ebook.edit',$ebook->id)}}"><span class="btn btn-sm btn-success d-none d-lg-inline-block">Edit</span></a>
                                    <a href="{{route('admin.ebook.edit',$ebook->id)}}" class="me-1"><i class="fa-solid fa-pen-to-square text-success d-lg-none"></i></a>
                                    <a href="{{route('admin.ebook.delete',$ebook->id)}}" onclick="return confirm('Are you sure?')"><span class="btn btn-sm btn-danger d-none d-lg-inline-block">Delete</span></a>
                                    <a href="{{route('admin.ebook.delete',$ebook->id)}}"><i class="fa-solid fa-trash text-danger d-lg-none"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $ebooks->links() }}
                </div>
            </div>
        </div>
        <div class="d-md-none card">
            <div class="card-header">
                <h3 class="f-3 text-center">Ebooks List</h3>
                <div class="col-12">
                    <form action="{{ route('admin.ebook.index') }}" method="GET" class="text-center">
                        <div class="form-group d-inline-block col-8">
                            <input type="text" name="s" class="form-control" placeholder="Search" value="{{Request::get('s')}}" />
                        </div>
                        <button type="submit" class="btn btn-outline-danger d-inline">Search</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row f-5">
                    @foreach($ebooks as $ebook)
                    <div class="col-6 px-1">
                        <div class="col-12 mb-2 p-1 rounded-1 border border-danger-subtle bg-body-secondary shadow-sm small-card">
                            <p class="mb-1">Title : {{$ebook->title}}</p>
                            <p class="mb-1">Author :
                                @foreach($ebook->author as $author)
                                <span>
                                    {{$author->name}}
                                    @if (!($loop->last))
                                    ,
                                    @endif
                                </span>
                                @endforeach
                            </p>
                            <p class="mb-1">Category :
                                @foreach($ebook->category as $category)
                                <span class="bg-danger-subtle rounded-1 px-1 me-1">
                                    {{$category->name}}
                                </span>
                                @endforeach
                            </p>
                            <p class="mb-1">Price : {{$ebook->price}} MMK</p>
                            <div class="text-end">
                                <a href="{{route('admin.ebook.edit',$ebook->id)}}" class="me-2"><i class="fa-solid fa-pen-to-square text-success"></i></a>
                                <a href="{{route('admin.ebook.delete',$ebook->id)}}" class="me-2"><i class="fa-solid fa-trash text-danger"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
