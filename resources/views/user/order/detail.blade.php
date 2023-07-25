@extends('layouts.master')
@section('title')
Order Detail
@endsection
@section('content')
<div class="order-detail-pg">
    <div class="col-11 col-lg-10 mx-auto mt-4 mt-lg-0">
        <h3 class="f-3">Orders ID : {{$order->id}}</h3>
        <div class="card d-none d-md-block">
            <div class="card-header">
                <h3 class="f-4">Items</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped f-6">
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
                            <td><a href="{{($order->status == 'accepted')? '/user/private/'.$ebook->link : ''}}" class="ebook-link">{{($order->status == 'accepted')? 'Link' : ''}}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row row-cols-2 d-md-none">
            @foreach($order->book as $book)
            <div class="col px-2 mb-3">
                <div class="bg-secondary-subtle rounded-1 p-2 small-card">
                    <p class="f-5">Type : Book</p>
                    <p class="f-5">Title : {{$book->title}}</p>
                    <p class="f-5">Price : {{$book->price}}</p>
                    <p class="f-5">Quantity : {{$book->pivot->quantity}}</p>
                </div>
            </div>
            @endforeach
            @foreach($order->ebook as $ebook)
            <div class="col px-2 mb-3">
                <div class="bg-secondary-subtle rounded-1 p-2 small-card">
                    <p class="f-5">Type : Ebook</p>
                    <p class="f-5">Title : {{$ebook->title}}</p>
                    <p class="f-5">Price : {{$ebook->title}}</p>
                    <a href="{{($order->status == 'accepted')? $ebook->link : ''}}">{{($order->status == 'accepted')? 'Link' : ''}}</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-2 clearfix mb-2 f-5">
            <p class="float-end border border-dark p-1 me-1">Total : {{ $order->total_amount }} MMK</p>
            <p class="float-end border border-dark p-1 me-1">Payment : {{ $order->payment->name }}</p>
            <p class="float-end border border-dark p-1 me-1">Status : {{ $order->status }}</p>
        </div>
        @if ($order->status == 'pending')
        <a href="{{ route('user.order.cancel',$order->id)}}"><span class="btn btn-danger float-end">Cancel</span></a>
        @endif
        <a href="{{ url()->previous() }}"><span class="btn btn-secondary float-end">Back</span></a>
    </div>
</div>
@endsection
