@extends('layouts.master')
@section('title')
Payment List
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
    <div class="col-3">
        <a href="{{ route('admin.payment.create') }}"><span class="btn btn-primary mt-5">Create</span></a>
    </div>
    <div class="col-3 offset-6 mt-5">
        <form action="{{ route('admin.payment.import') }}" method="POST" class="d-inline" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="" id="choose">
            <button type="button" class="btn btn-dark" id="show-btn"
                onclick="document.getElementById('choose').click()">Import</button>
            <button type="submit" class="btn btn-dark import-btn">Import</button>
        </form>
        <a href="{{ route('admin.payment.export') }}" class="btn btn-dark">Export</a>
    </div>
</div>
<div class="mt-3">
    <div class="col-12 align-self-center">
        <div class="card">
            <div class="card-header">
                <h3>Payment Lists</h3>
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
                        @foreach($payments as $payment)
                        <tr>
                            <th scope="row">{{$payment->id}}</th>
                            <td>{{$payment->name}}</td>
                            <td>
                                <a href="{{route('admin.payment.edit',$payment->id)}}"><span class="btn btn-success">Edit</span></a>
                                <a href="{{route('admin.payment.delete',$payment->id)}}" onclick="return confirm('Are you sure?')"><span class="btn btn-danger">Delete</span></a>
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
