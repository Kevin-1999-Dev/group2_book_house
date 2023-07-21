@extends('layouts.master')
@section('title')
Order List
@endsection
@section('content')
<div class="auth-order col-12 col-md-10 mx-auto pb-5">
<div class="">
    <a href="{{ route('admin.dashboard') }}">
        <i class="fa-solid fa-arrow-left-long"></i> <span class="f-4">Back</span>
    </a>
</div>
<div class="row mt-2">
    <div class="col-2 offset-10">
        <a href="{{ route('admin.order.export') }}" class="btn btn-dark">Export</a>
    </div>
</div>
<div class="mt-3">
    <div class="col-12 align-self-center">
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
                                <a href="{{route('admin.order.detail',$order->id)}}"><span class="btn btn-sm btn-success">View</span></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
