@extends('layuouts.master')
@section('title')
Order Detail
@endsection
@section('content')
<div class="row mt-3">
    <div class="col-12 align-self-center clearfix">
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
                            <td scope="col">Price</td>
                            <td scope="col">Quantity</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->book as $book)
                        <tr>
                            <td>{{$book->title}}</td>
                            <td>{{$book->price}} MMK</td>
                            <td>{{$book->pivot->quantity}}</td>
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
                            <td scope="col">Price</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->ebook as $ebook)
                        <tr>
                            <td>{{$ebook->title}}</td>
                            <td>{{$ebook->price}} MMK</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-3 clearfix">
            <h5 class="float-end">Total : {{ $order->total_amount }} MMK</h5>
        </div>
        <form action="{{ route('admin.order.update',$order->id)}}" method="post" class="mb-3 float-end">
            @csrf
            <div class="form-group">
                <label for="status">Status : </label>
                <select name="status">
                    <option value="accepted" {{$order->status=='accepted' ? 'selected' : ''}}>accepted</option>
                    <option value="declined" {{$order->status=='declined' ? 'selected' : ''}}>declined</option>
                    <option value="pending" {{$order->status=='pending' ? 'selected' : ''}}>pending</option>
                </select>
            </div>
            <div class="form-group mt-4">
                <a href="{{ route('admin.order.index')}}"><span class="btn btn-secondary float-left">Back</span></a>
                <input type="submit" class="btn btn-primary float-right" value="Submit">
            </div>
        </form>
    </div>
</div>
@endsection
