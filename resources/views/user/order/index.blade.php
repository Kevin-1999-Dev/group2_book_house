@extends('layouts.master')
@section('title')
Order History
@endsection
@section('content')
<div class="container mt-3">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show col-md-6 mx-auto" role="alert">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="col-12 align-self-center">
        <div class="card">
            <div class="card-header">
                <h3 class="float-start">Orders History</h3>
                <div class="float-end">
                    <form action="{{ route('user.order.index') }}" method="GET">
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
                            <th scope="col">Status</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <th scope="row">{{$order->id}}</th>
                            <td>{{$order->status}}</td>
                            <td>{{$order->payment->name}}</td>
                            <td>{{$order->total_amount}} MMK</td>
                            <td>
                                <a href="{{route('user.order.detail',$order->id)}}"><span class="btn btn-success">View</span></a>
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
