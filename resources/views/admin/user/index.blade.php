@extends('layouts.master')
@section('title')
User List
@endsection
@section('content')
<div class="user-pg col-11 col-md-10 col-lg-8 mx-auto pb-5">
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
    <div class=" d-none d-md-block">
        <a href="{{ url()->previous() }}">
            <i class="fa-solid fa-arrow-left-long"></i> <span class="f-4">Back</span>
        </a>
    </div>
    <div class="row mt-md-2">
        <div class="col-12 text-end">
            <form action="{{ route('admin.user.import') }}" method="POST" class="d-inline" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="" id="choose">
                <button type="button" class="btn btn-dark" id="show-btn" onclick="document.getElementById('choose').click()">Import</button>
                <button type="submit" class="btn btn-dark import-btn">Import</button>
            </form>
            <a href="{{ route('admin.user.export') }}" class="btn btn-dark">Export</a>
        </div>
    </div>
    <div class="mt-3">
        <div class="col-12 align-self-center d-none d-md-block">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-start f-3">User List</h3>
                    <div class="float-end">
                        <form action="{{ route('admin.user.index') }}" method="GET">
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
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Active</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role ? 'admin' : 'user'}}</td>
                                <td>{{$user->active ? 'enable' : 'disable'}}</td>
                                <td>
                                    <a href="{{route('admin.user.edit',$user->id)}}"><span class="btn btn-sm btn-success d-none d-lg-inline-block">Edit</span></a>
                                    <a href="{{route('admin.user.edit',$user->id)}}" class="me-1"><i class="fa-solid fa-pen-to-square text-success d-lg-none"></i></a>
                                    <a href="{{route('admin.user.delete',$user->id)}}" onclick="return confirm('Are you sure?')"><span class="btn btn-sm btn-danger d-none d-lg-inline-block">Delete</span></a>
                                    <a href="{{route('admin.user.delete',$user->id)}}"><i class="fa-solid fa-trash text-danger d-lg-none"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
        <div class="d-md-none card">
            <div class="card-header">
                <h3 class="f-3 text-center">User List</h3>
                <div class="col-12">
                    <form action="{{ route('admin.user.index') }}" method="GET" class="text-center">
                        <div class="form-group d-inline-block col-8">
                            <input type="text" name="s" class="form-control" placeholder="Search" value="{{Request::get('s')}}" />
                        </div>
                        <button type="submit" class="btn btn-outline-danger d-inline">Search</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row f-5">
                    @foreach($users as $user)
                    <div class="col-6 px-1">
                        <div class="col-12 mb-2 p-1 rounded-1 border border-danger-subtle bg-body-secondary shadow-sm small-card">
                            <p class="mb-1">ID : {{$user->id}}</p>
                            <p class="mb-1">Name : {{$user->name}}</p>
                            <p class="mb-1">Email : {{$user->email}}</p>
                            <p class="mb-1">Role : {{$user->role ? 'admin' : 'user'}}</p>
                            <p class="mb-1">Active : {{$user->active ? 'enable' : 'disable'}}</p>
                            <div class="text-end">
                                <a href="{{route('admin.user.edit',$user->id)}}" class="me-2"><i class="fa-solid fa-pen-to-square text-success"></i></a>
                                <a href="{{route('admin.user.delete',$user->id)}}" class="me-2"><i class="fa-solid fa-trash text-danger"></i></a>
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
