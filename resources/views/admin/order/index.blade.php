@extends('layouts.master')
@section('title')
Order List
@endsection
@section('content')
<div class="">
    <a href="{{ route('admin.dashboard') }}">
        <i class="fa-solid fa-arrow-left-long"></i> <span class="fs-3">Back</span>
    </a>
</div>
<div class="container mt-3">
    <div class="col-12 align-self-center">
        <div class="card">
            <div class="card-header">
                <h3 class="float-start">Orders List</h3>
                <div class="float-end">
                    <form action="{{ route('admin.order.index') }}" method="GET">
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
                                <a href="{{route('admin.order.detail',$order->id)}}"><span class="btn btn-success">View</span></a>
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
