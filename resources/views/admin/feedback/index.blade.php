@extends('layouts.master')
@section('title')
Feedback List
@endsection
@section('content')
<div class="auth-feedback col-11 col-md-10 mx-auto ">
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
    <div class=" d-none d-md-block">
        <a href="{{ route('admin.dashboard') }}">
            <i class="fa-solid fa-arrow-left-long"></i> <span class="f-4">Back</span>
        </a>
    </div>
    <div class="row mt-md-2">
        <div class="col-12 text-end">
            <form action="{{ route('admin.feedback.import') }}" method="POST" class="d-inline" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="" id="choose">
                <button type="button" class="btn btn-dark" id="show-btn" onclick="document.getElementById('choose').click()">Import</button>
                <button type="submit" class="btn btn-dark import-btn">Import</button>
            </form>
            <a href="{{ route('admin.feedback.export') }}" class="btn btn-dark">Export</a>
        </div>
    </div>
    <div class="mt-3">
        <div class="col-12 align-self-center d-none d-md-block">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-start f-3">Feedback List</h3>
                    <div class="float-end">
                        <form action="{{ route('admin.feedback.index') }}" method="GET">
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
                                    <button type="button" class="btn btn-sm btn-success d-none d-lg-inline-block" data-bs-toggle="modal" data-bs-target="#detailModal" data-bs-modal-id="{{$feedback->id}}">View</button>
                                    <a type="button" class="me-1 d-lg-none" data-bs-toggle="modal" data-bs-target="#detailModal" data-bs-modal-id="{{$feedback->id}}"><i class="fa-solid fa-eye text-success d-lg-none"></i></a>
                                    <a href="{{route('admin.feedback.delete',$feedback->id)}}" onclick="return confirm('Are you sure?')"><span class="btn btn-sm btn-danger d-none d-lg-inline-block">Delete</span></a>
                                    <a href="{{route('admin.feedback.delete',$feedback->id)}}" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash text-danger d-lg-none"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $feedbacks->links() }}
                </div>
            </div>
        </div>
        <div class="d-md-none card">
            <div class="card-header">
                <h3 class="f-3 text-center">Feedback List</h3>
                <div class="col-12">
                    <form action="{{ route('admin.feedback.index') }}" method="GET" class="text-center">
                        <div class="form-group d-inline-block col-8">
                            <input type="text" name="s" class="form-control" placeholder="Search" value="{{Request::get('s')}}" />
                        </div>
                        <button type="submit" class="btn btn-outline-danger d-inline">Search</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row f-5">
                    @foreach($feedbacks as $feedback)
                    <div class="px-1">
                        <div class="col-12 mb-2 p-1 rounded-1 border border-danger-subtle bg-body-secondary shadow-sm">
                            <p class="mb-1">ID : {{$feedback->id}}</p>
                            <p class="mb-1">Name : {{$feedback->name}}</p>
                            <p class="mb-1">Email : {{$feedback->email}}</p>
                            <p class="mb-1">Subject : {{$feedback->subject}}</p>
                            <div class="text-end">
                            <a type="button" class="me-2" data-bs-toggle="modal" data-bs-target="#detailModal" data-bs-modal-id="{{$feedback->id}}"><i class="fa-solid fa-eye text-success d-lg-none"></i></a>
                            <a href="{{route('admin.feedback.delete',$feedback->id)}}" onclick="return confirm('Are you sure?')" class="me-2"><i class="fa-solid fa-trash text-danger d-lg-none"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
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
