@extends('layouts.master')
@section('title')
Payment List
@endsection
@section('content')
<a href="{{ route('admin.payment.create')}}"><span class="btn btn-primary mt-3">Create</span></a>
<div class="container mt-3">
    <div class="col-12 align-self-center">
        <div class="card">
            <div class="card-header">
                <h3>Payment Lists</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <th scope="row">{{$payment->id}}</th>
                            <td>{{$payment->name}}</td>
                            <td>
                                <a href="{{route('admin.payment.edit',$payment->id)}}"><span class="btn btn-success">Edit</span></a>
                                <a href="{{route('admin.payment.delete',$payment->id)}}" onclick="return confirm('Are you sure?')"><span class="btn btn-danger">Delete</span></a>
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
