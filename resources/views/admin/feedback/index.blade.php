@extends('layouts.master')
@section('title')
Feedback List
@endsection
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session('importSuccess'))
<div class="alert alert-success alert-dismissible fade show col-4" role="alert">
    {{ session('importSuccess') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="">
    <a href="{{ route('admin.dashboard') }}">
        <i class="fa-solid fa-arrow-left-long"></i> <span class="fs-3">Back</span>
    </a>
</div>
<div class="row">
    <div class="col-2 offset-10 mt-5">
        <form action="{{ route('admin.feedback.import') }}" method="POST" class="d-inline" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="" id="choose">
            <button type="button" class="btn btn-dark" id="show-btn"
                onclick="document.getElementById('choose').click()">Import</button>
            <button type="submit" class="btn btn-dark import-btn">Import</button>
        </form>
        <a href="{{ route('admin.feedback.export') }}" class="btn btn-dark">Export</a>
    </div>
</div>
<div class="mt-3">
    <div class="col-12 align-self-center">
        <div class="card">
            <div class="card-header">
                <h3 class="float-start">Feedback List</h3>
                <div class="float-end">
                    <form action="{{ route('admin.feedback.index') }}" method="GET">
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
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $feedback)
                        <tr>
                            <th scope="row">{{$feedback->id}}</th>
                            <td>{{$feedback->name}}</td>
                            <td>{{$feedback->email}}</td>
                            <td>{{$feedback->subject}}</td>
                            <td>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detailModal" data-bs-modal-id="{{$feedback->id}}">View</button>
                                <a href="{{route('admin.feedback.delete',$feedback->id)}}"><span class="btn btn-danger">Delete</span></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detailModalLabel">Detail</h1>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Name</td>
                                <td> : </td>
                                <td class="name"></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> : </td>
                                <td class="email"></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td> : </td>
                                <td class="address"></td>
                            </tr>
                            <tr>
                                <td>Subject</td>
                                <td> : </td>
                                <td class="subject"></td>
                            </tr>
                            <tr>
                                <td>Message</td>
                                <td> : </td>
                                <td class="message"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    const detailModal = document.getElementById('detailModal');
    detailModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        let id = button.getAttribute('data-bs-modal-id');
        axios.get("/admin/feedback/detail/" + id)
            .then(function(response) {
                detailModal.querySelector('.modal-body .name').textContent = response.data['name'];
                detailModal.querySelector('.modal-body .email').textContent = response.data['email'];
                detailModal.querySelector('.modal-body .address').textContent = response.data['address'];
                detailModal.querySelector('.modal-body .subject').textContent = response.data['subject'];
                detailModal.querySelector('.modal-body .message').textContent = response.data['message'];
            });

    });
</script>

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#show-btn').click(function() {
                $(this).toggle();
                $('.import-btn').toggleClass('import-btn');
            });
        });
    </script>
@endsection
