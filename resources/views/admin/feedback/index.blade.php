@extends('layouts.master')
@section('title')
Feedback List
@endsection
@section('content')
<div class="">
    <a href="{{ route('admin.dashboard') }}">
        <i class="fa-solid fa-arrow-left-long"></i> <span class="fs-3">Back</span>
    </a>
</div>
<div class="container mt-3">
    <div class="col-12 align-self-center">
        <div class="card">
            <div class="card-header">
                <h3 class="float-start">Feedback List</h3>
                <div class="float-end">
                    <form action="{{ route('admin.feedback.index') }}" method="GET">
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
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedback as $f)
                        <tr>
                            <th scope="row">{{$f->id}}</th>
                            <td>{{$f->name}}</td>
                            <td>{{$f->email}}</td>
                            <td>{{$f->subject}}</td>
                            <td>
                                <a href="{{route('admin.feedback.detail',$f->id)}}"><span class="btn btn-success">View</span></a>
                                <a href="{{route('admin.feedback.delete',$f->id)}}"><span class="btn btn-danger">Delete</span></a>
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
