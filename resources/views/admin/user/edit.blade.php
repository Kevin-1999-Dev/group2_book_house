@extends('admin.layouts.master')
@section('title')
Edit User
@endsection
@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h3>Edit User</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.user.update',$user->id)}}" method="post" class="mt-4 p-4">
            @csrf
            <div class="form-group m-3">
                <label for="role">Role</label>
                <select class="form-control" name="role">
                    <option value="admin" {{$user->role=='1' ? 'selected' : ''}}>Admin</option>
                    <option value="user" {{$user->role=='0' ? 'selected' : ''}}>User</option>
                </select>
            </div>
            <div class="form-group m-3">
                <label for="active">Active</label>
                <select class="form-control" name="active">
                    <option value="enable" {{$user->active=='1' ? 'selected' : ''}}>Enable</option>
                    <option value="disable" {{$user->active=='0' ? 'selected' : ''}}>Disable</option>
                </select>
            </div>
            <div class="form-group m-3">
                <a href="{{ route('admin.user.index')}}"><span class="btn btn-secondary float-left">Back</span></a>
                <input type="submit" class="btn btn-primary float-right" value="Edit">
            </div>
        </form>
    </div>
</div>
@endsection
