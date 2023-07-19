@extends('layouts.master')
@section('title')
Feedback List
@endsection
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session('importSuccess'))
<div class="alert alert-success alert-dismissible fade show col-4" role="alert">
    {{ session('importSuccess') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="">
    <a href="{{ route('admin.dashboard') }}">
        <i class="fa-solid fa-arrow-left-long"></i> <span class="fs-3">Back</span>
    </a>
</div>
<div class="row">
    <div class="col-2 offset-10 mt-5">
        <form action="{{ route('admin.feedback.import') }}" method="POST" class="d-inline" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="" id="choose">
            <button type="button" class="btn btn-dark" id="show-btn"
                onclick="document.getElementById('choose').click()">Import</button>
            <button type="submit" class="btn btn-dark import-btn">Import</button>
        </form>
        <a href="{{ route('admin.feedback.export') }}" class="btn btn-dark">Export</a>
    </div>
</div>
<div class="mt-3">
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
@section('script')
    <script>
        $(document).ready(function() {
            $('#show-btn').click(function() {
                $(this).toggle();
                $('.import-btn').toggleClass('import-btn');
            });
        });
    </script>
@endsection
