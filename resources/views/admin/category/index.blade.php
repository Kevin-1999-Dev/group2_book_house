@extends('layouts.master')
@section('title')
Category List
@endsection
@section('content')
<div class="category-pg col-11 col-md-10 col-lg-8 mx-auto pb-5">
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
    <a href="{{ route('admin.dashboard') }}">
        <i class="fa-solid fa-arrow-left-long"></i> <span class="f-4">Back</span>
    </a>
    <div class="row mt-4">
        <div class="col-3">
            <a href="{{ route('admin.category.create') }}"><span class="btn btn-primary">Create</span></a>
        </div>
        <div class="col-9 text-end">
            <form action="{{ route('admin.category.import') }}" method="POST" class="d-inline" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="" id="choose">
                <button type="button" class="btn btn-dark" id="show-btn" onclick="document.getElementById('choose').click()">Import</button>
                <button type="submit" class="btn btn-dark import-btn">Import</button>
            </form>
            <a href="{{ route('admin.category.export') }}" class="btn btn-dark">Export</a>
        </div>
    </div>
    <div class="mt-4">
        <div class="col-12 align-self-center">
            <div class="card">
                <div class="card-header d-none d-md-block">
                    <h3 class="float-start f-3">Category List</h3>
                    <div class="float-end">
                        <form action="{{ route('admin.category.index') }}" method="GET">
                            <div class="form-group d-inline-block">
                                <input type="text" name="s" class="form-control" placeholder="Search" value="{{Request::get('s')}}" />
                            </div>
                            <button type="submit" class="btn btn-outline-danger d-inline">Search</button>
                        </form>
                    </div>
                </div>
                <div class="card-header text-center d-md-none">
                    <h3 class="f-3 mb-1">Category List</h3>
                    <form action="{{ route('admin.category.index') }}" method="GET">
                        <div class="form-group d-inline-block">
                            <input type="text" name="s" class="form-control" placeholder="Search" value="{{Request::get('s')}}" />
                        </div>
                        <button type="submit" class="btn btn-outline-danger d-inline">Search</button>
                    </form>
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
                            @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('admin.category.edit', $category->id) }}"><span class="btn btn-sm btn-success d-none d-lg-inline-block">Edit</span></a>
                                    <a href="{{ route('admin.category.edit', $category->id) }}" class="me-1"><i class="fa-solid fa-pen-to-square text-success d-lg-none"></i></a>
                                    <a href="{{ route('admin.category.delete', $category->id) }}" onclick="return confirm('Are you sure?')"><span class="btn btn-sm btn-danger d-none d-lg-inline-block">Delete</span></a>
                                    <a href="v"><i class="fa-solid fa-trash text-danger d-lg-none"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links() }}
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
