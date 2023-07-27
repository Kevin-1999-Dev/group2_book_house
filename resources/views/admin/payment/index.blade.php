@extends('layouts.master')
@section('title')
Payment List
@endsection
@section('content')
<div class="payment-pg col-11 col-md-10 col-lg-8 mx-auto pb-5">
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
            <i class="fa-solid fa-arrow-left-long"></i> <span class="f-4">Back</span>
        </a>
    </div>
    <div class="row mt-4">
        <div class="col-3">
            <a href="{{ route('admin.payment.create') }}"><span class="btn btn-primary">Create</span></a>
        </div>
        <div class="col-9 text-end">
            <a href="{{ route('admin.payment.export') }}" class="btn btn-dark">Export</a>
        </div>
    </div>
    <div class="mt-3">
        <div class="col-12 align-self-center">
            <div class="card">
                <div class="card-header d-none d-md-block">
                    <h3 class="float-start f-3">Payment List</h3>
                    <div class="float-end">
                        <form action="{{ route('admin.payment.index') }}" method="GET">
                            <div class="form-group d-inline-block">
                                <input type="text" name="s" class="form-control" placeholder="Search" value="{{Request::get('s')}}" />
                            </div>
                            <button type="submit" class="btn btn-outline-danger d-inline">Search</button>
                        </form>
                    </div>
                </div>
                <div class="card-header text-center d-md-none">
                    <h3 class="f-3 mb-1">Payment List</h3>
                    <form action="{{ route('admin.payment.index') }}" method="GET">
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
                            @foreach($payments as $payment)
                            <tr>
                                <th scope="row">{{$payment->id}}</th>
                                <td>{{$payment->name}}</td>
                                <td>
                                    <a href="{{route('admin.payment.edit',$payment->id)}}"><span class="btn btn-sm btn-success d-none d-lg-inline-block">Edit</span></a>
                                    <a href="{{route('admin.payment.edit',$payment->id)}}" class="me-1"><i class="fa-solid fa-pen-to-square text-success d-lg-none"></i></a>
                                    <a href="{{route('admin.payment.delete',$payment->id)}}" onclick="return confirm('Are you sure?')"><span class="btn btn-sm btn-danger d-none d-lg-inline-block">Delete</span></a>
                                    <a href="{{route('admin.payment.delete',$payment->id)}}"><i class="fa-solid fa-trash text-danger d-lg-none"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $payments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

