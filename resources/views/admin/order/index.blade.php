@extends('layouts.master')
@section('title')
Order List
@endsection
@section('content')
<div class="auth-order col-11 col-md-10 mx-auto pb-5">
    <div class=" d-none d-md-block">
        <a href="{{ url()->previous() }}">
            <i class="fa-solid fa-arrow-left-long"></i> <span class="f-4">Back</span>
        </a>
    </div>
    <div class="row mt-md-2">
        <div class="col-12 text-end">
            <a href="{{ route('admin.order.export') }}" class="btn btn-dark">Export</a>
        </div>
    </div>
    <div class="mt-3">
        <div class="col-12 align-self-center d-none d-md-block">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-start f-3">Orders List</h3>
                    <div class="float-end">
                        <form action="{{ route('admin.order.index') }}" method="GET">
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
                                <th scope="col">User</th>
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
                                <td>{{$order->user->name}}</td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->payment->name}}</td>
                                <td>{{$order->total_amount}} MMK</td>
                                <td>
                                    <a href="{{route('admin.order.detail',$order->id)}}"><span class="btn btn-sm btn-success d-none d-lg-inline-block">View</span></a>
                                    <a href="{{route('admin.order.detail',$order->id)}}"><i class="fa-solid fa-eye text-success d-lg-none"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
        <div class="d-md-none card">
            <div class="card-header">
                <h3 class="f-3 text-center">Order List</h3>
                <div class="col-12">
                    <form action="{{ route('admin.order.index') }}" method="GET" class="text-center">
                        <div class="form-group d-inline-block col-8">
                            <input type="text" name="s" class="form-control" placeholder="Search" value="{{Request::get('s')}}" />
                        </div>
                        <button type="submit" class="btn btn-outline-danger d-inline">Search</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row f-5">
                    @foreach($orders as $order)
                    <div class="col-6 px-1">
                        <div class="col-12 mb-2 p-1 rounded-1 border border-danger-subtle bg-body-secondary shadow-sm small-card">
                            <p class="mb-1">ID : {{$order->id}}</p>
                            <p class="mb-1">User : {{$order->user->name}}</p>
                            <p class="mb-1">Status : {{$order->status}}</p>
                            <p class="mb-1">Payment : {{$order->payment->name}}</p>
                            <p class="mb-1">Amount : {{$order->total_amount}} MMK</p>
                            <div class="text-end">
                                <a href="{{route('admin.order.detail',$order->id)}}" class="me-2"><i class="fa-solid fa-eye text-success"></i></a>
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
