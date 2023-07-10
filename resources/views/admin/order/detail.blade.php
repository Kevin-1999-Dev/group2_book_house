@extends('admin.layouts.master')
@section('title')
Order Status
@endsection
@section('content')
<div class="row mt-3">
    <div class="col-12 align-self-center">
        <h3>Orders by {{$order->user->name}}</h3>
        <div class="card">
            <div class="card-header">
                <h3>Book Orders</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col" style="text-align:end;">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->book as $book)
                        <tr>
                            <td>{{$book->title}}</td>
                            <td style="text-align:end;">{{$book->price}} MMK</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br />
        <div class="card">
            <div class="card-header">
                <h3>Ebook Orders</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col" style="text-align:end;">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->ebook as $ebook)
                        <tr>
                            <td>{{$ebook->title}}</td>
                            <td style="text-align:end;">{{$ebook->price}} MMK</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="float-end mt-3 mb-2">
            <h5>Total : {{ $order->total_amount }} MMK</h5>
            <a href="{{ route('admin.order.accept',$order->id)}}"><span class="btn btn-primary mt-3">Accept</span></a>
            <a href="{{ route('admin.order.decline',$order->id)}}"><span class="btn btn-danger mt-3 float-end">Decline</span></a>
        </div>
    </div>
</div>
@endsection
