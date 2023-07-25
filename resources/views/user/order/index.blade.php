@extends('layouts.master')
@section('title')
Order History
@endsection
@section('content')
<div class="order-pg px-3">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show col-md-6 mx-auto" role="alert">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="col-11 col-lg-10 mx-auto mt-4 mt-md-0 d-none d-md-block">
        <div class="card">
            <div class="card-header">
                <h3 class="float-start f-4 mt-md-2 mt-lg-1">Orders History</h3>
                <div class="float-end">
                    <form action="{{ route('user.order.index') }}" method="GET">
                        <div class="form-group d-inline-block">
                            <input type="text" name="s" class="form-control" placeholder="Search" value="{{Request::get('s')}}" />
                        </div>
                        <button type="submit" class="btn btn-outline-danger d-inline">Search</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped f-6">
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
                                <a href="{{route('user.order.detail',$order->id)}}"><span class="btn btn-sm btn-success">View</span></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 d-md-none">
        <h3 class="f-3 text-center">Orders History</h3>
        <form action="{{ route('user.order.index') }}" method="GET" class="mt-2 mb-3 text-center">
            <div class="form-group d-inline-block col-9">
                <input type="text" name="s" class="form-control" placeholder="Search" value="{{Request::get('s')}}" />
            </div>
            <button type="submit" class="btn btn-outline-danger d-inline">Search</button>
        </form>
        <div class="row">
            @foreach($orders as $order)
            <div class="col-6 col-sm-4 px-2 mb-3">
                <div class="bg-secondary-subtle rounded-1 p-2 small-card">
                    <p class="f-6">Order ID : {{$order->id}}</p>
                    <p class="f-5">Status : {{$order->status}}</p>
                    <p class="f-5">Payment : {{$order->payment->name}}</p>
                    <p class="f-5">Total : {{$order->total_amount}} MMK</p>
                    <a href="{{route('user.order.detail',$order->id)}}" class="btn btn-sm btn-success">View</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
