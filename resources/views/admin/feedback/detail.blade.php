@extends('admin.layouts.master')
@section('title')
Feedback Detail
@endsection
@section('content')
<div class="row mt-3">
    <div class="col-12 align-self-center clearfix">
        <div class="card">
            <div class="card-header">
                <h3>Feedback by {{$feedback->name}}</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>Name</td>
                        <td> : </td>
                        <td>{{$feedback->name}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td> : </td>
                        <td>{{$feedback->email}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td> : </td>
                        <td>{{$feedback->address}}</td>
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <td> : </td>
                        <td>{{$feedback->subject}}</td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td> : </td>
                        <td>{{$feedback->message}}</td>
                    </tr>
                </table>
            </div>
            <a href="{{ route('admin.feedback.index')}}"><span class="btn btn-secondary float-end m-3">Back</span></a>
        </div>
    </div>
</div>
@endsection
