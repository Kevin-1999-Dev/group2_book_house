@extends('layouts.master')
@section('title')
Order Detail
@endsection
@section('content')
<div class="auth-order-detail col-11 col-md-10 mx-auto py-2">
    <div class="col-12 align-self-center clearfix">
        <h3 class="f-3">Orders by {{$order->user->name}}</h3>
        <div class="card my-2">
            <div class="card-header">
                <h4 class="f-4">Orders</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped f-7">
                    <thead>
                        <tr>
                            <td scope="col">Type</td>
                            <td scope="col">Title</td>
                            <td scope="col">Price</td>
                            <td scope="col"><span class="d-none d-md-block">Quantity</span><span class="d-md-none">Qty</span></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->book as $book)
                        <tr>
                            <td>Book</td>
                            <td>{{$book->title}}</td>
                            <td>{{$book->price}} MMK</td>
                            <td>{{$book->pivot->quantity}}</td>
                        </tr>
                        @endforeach
                        @foreach($order->ebook as $ebook)
                        <tr>
                            <td>Ebook</td>
                            <td>{{$ebook->title}}</td>
                            <td>{{$ebook->price}} MMK</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="my-2 clearfix">
            <h5 class="float-end border border-dark p-1 f-6">Payment : {{ $order->payment->name }} | Total : {{ $order->total_amount }} MMK</h5>
        </div>
        @if ($order->status=='pending')
        <form action="{{ route('admin.order.update',$order->id)}}" method="post" class="mb-3 float-end">
            @csrf
            <div class="form-group f-6">
                <label for="status">Status : </label>
                <select name="status">
                    <option value="accepted" {{$order->status=='accepted' ? 'selected' : ''}}>accepted</option>
                    <option value="declined" {{$order->status=='declined' ? 'selected' : ''}}>declined</option>
                    <option value="pending" {{$order->status=='pending' ? 'selected' : ''}}>pending</option>
                </select>
            </div>
            <div class="form-group mt-2 mt-lg-4">
                <a href="{{ url()->previous() }}" class="d-none d-lg-inline-block"><span class="btn btn-secondary float-start">Back</span></a>
                <input type="submit" class="btn btn-primary float-end d-none d-lg-inline-block" value="Submit">
                <a href="{{ url()->previous() }}" class="d-lg-none"><span class="btn btn-sm btn-secondary float-start">Back</span></a>
                <input type="submit" class="btn btn-sm btn-primary float-end d-lg-none" value="Submit">
            </div>
        </form>
        @else
        <a href="{{ url()->previous() }}" class="d-none float-end d-lg-inline-block"><span class="btn btn-secondary float-start">Back</span></a>
        <a href="{{ url()->previous() }}" class="float-end d-lg-none"><span class="btn btn-sm btn-secondary float-start">Back</span></a>
        @endif
    </div>
</div>
@endsection
