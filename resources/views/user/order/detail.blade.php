@extends('layouts.master')
@section('title')
Order Detail
@endsection
@section('content')
<div class="container mt-3">
    <div class="col-12 align-self-center clearfix">
        <h3>Orders ID : {{$order->id}}</h3>
        <div class="card">
            <div class="card-header">
                <h3>Items</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td scope="col">Type</td>
                            <td scope="col">Title</td>
                            <td scope="col">Price</td>
                            <td scope="col">Quantity</td>
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
        <div class="mt-2 clearfix">
            <h5 class="float-end border border-dark p-1">Total : {{ $order->total_amount }} MMK</h5>
            <h5 class="float-end border border-dark p-1">Payment : {{ $order->payment->name }}</h5>
            <h5 class="float-end border border-dark p-1">Status : {{ $order->status }}</h5>
        </div>
        <a href="{{ route('user.order.index')}}"><span class="btn btn-secondary float-end">Back</span></a>
    </div>
</div>
@endsection
