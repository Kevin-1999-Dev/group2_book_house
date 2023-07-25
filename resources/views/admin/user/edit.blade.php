@extends('layouts.master')
@section('title')
Edit User
@endsection
@section('content')
<div class="user-edit-pg col-11 col-md-10 col-lg-8 mx-auto pb-5">
    <div class="card">
        <div class="card-header">
            <h3 class="f-3">Edit User</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user.update',$user->id)}}" method="post" class="px-lg-4 f-7">
                @csrf
                <div class="form-group m-3">
                    <label for="role" class="form-label f-6">Role</label>
                    <select class="form-control" name="role">
                        <option value="admin" {{$user->role=='1' ? 'selected' : ''}}>Admin</option>
                        <option value="user" {{$user->role=='0' ? 'selected' : ''}}>User</option>
                    </select>
                </div>
                <div class="form-group m-3">
                    <label for="active" class="form-label f-6">Active</label>
                    <select class="form-control" name="active">
                        <option value="enable" {{$user->active=='1' ? 'selected' : ''}}>Enable</option>
                        <option value="disable" {{$user->active=='0' ? 'selected' : ''}}>Disable</option>
                    </select>
                </div>
                <div class="form-group m-3">
                    <a href="{{ url()->previous() }}"><span class="btn btn-secondary float-start">Back</span></a>
                    <input type="submit" class="btn btn-primary float-end" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
