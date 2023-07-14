@extends('layouts.master')
@section('title')
Author List
@endsection
@section('content')
<a href="{{ route('admin.author.create')}}"><span class="btn btn-primary mt-5">Create</span></a>
<div class="float-end mt-5">
    <a href="" class="btn btn-dark text-white">Import</a>
    <a href="" class="btn btn-dark text-white">Export</a>
</div>
<div class="row mt-3">
    <div class="col-12 align-self-center">
        <div class="card">
            <div class="card-header">
                <h3>Author Lists</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($authors as $author)
                        <tr>
                            <th scope="row">{{$author->id}}</th>
                            <td>{{$author->name}}</td>
                            <td>
                                <a href="{{route('admin.author.edit',$author->id)}}"><span class="btn btn-success">Edit</span></a>
                                <a href="{{route('admin.author.delete',$author->id)}}" onclick="return confirm('Are you sure?')"><span class="btn btn-danger">Delete</span></a>
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
