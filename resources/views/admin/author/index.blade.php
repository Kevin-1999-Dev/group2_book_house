@extends('layouts.master')
@section('title')
Author List
@endsection
@section('content')
<div class="author-pg col-12 col-md-10 col-lg-8 mx-auto pb-5">
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
    <div class="col-12">
        <a href="{{ route('admin.dashboard') }}">
            <i class="fa-solid fa-arrow-left-long"></i> <span class="f-4">Back</span>
        </a>
    </div>
    <div class="row mt-4">
        <div class="col-3">
            <a href="{{ route('admin.author.create') }}"><span class="btn btn-primary">Create</span></a>
        </div>
        <div class="col-3 offset-6">
            <form action="{{ route('admin.author.import') }}" method="POST" class="d-inline" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="" id="choose">
                <button type="button" class="btn btn-dark" id="show-btn" onclick="document.getElementById('choose').click()">Import</button>
                <button type="submit" class="btn btn-dark import-btn">Import</button>
            </form>
            <a href="{{ route('admin.author.export') }}" class="btn btn-dark">Export</a>
        </div>
    </div>
    <div class="mt-3">
        <div class="col-12 align-self-center">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-start f-3">Author List</h3>
                    <div class="float-end">
                        <form action="{{ route('admin.author.index') }}" method="GET">
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
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($authors as $author)
                            <tr>
                                <th scope="row">{{ $author->id }}</th>
                                <td>{{ $author->name }}</td>
                                <td>
                                    <a href="{{ route('admin.author.edit', $author->id) }}"><span class="btn btn-sm btn-success">Edit</span></a>
                                    <a href="{{ route('admin.author.delete', $author->id) }}" onclick="return confirm('Are you sure?')"><span class="btn btn-sm btn-danger">Delete</span></a>
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