@extends('layouts.master')
@section('title')
Contact Us Page
@endsection
@section('content')
    <div class="contact-pg px-4 px-md-0">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show col-md-6 mx-auto" role="alert">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row py-3 main-row">
            <div class="col-md-6 ps-md-4 px-lg-5 mb-3 mb-md-0">
                <h2 class="mark-txt f-3 mb-2 mb-md-4">We value your feedback!</h2>
                <p class="contact-txt f-4">We would love to hear from you and appreciate any thoughts, suggestions, or
                    comments you have regarding our website. Your feedback helps us improve and enhance the overall
                    experience for all. Please take a moment to share your feedback with us.</p>
                <p class="mt-2 green-txt f-4">Thank you for your support! <i class="fa-regular fa-face-smile-wink"></i></p>
            </div>
            <!-- Message -->
            @if (empty(Auth::user()))
            <div class="col-md-6 px-md-3 px-lg-5">
                <h2 class="f-3 mb-3"><span class="border-bottom border-primary-subtle">Feedback here</span></h2>
                <form class="row g-3 f-6" action="{{ route('feedbacks.store') }}" method="post">
                    @csrf
                    <div class="col-md-6 form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            value="{{ old('email') }}">
                        <label for="email" class="form-label">Email</label>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                            value="{{ old('name') }}">
                        <label for="name" class="form-label">Name</label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 form-floating">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address"
                            value="{{ old('address') }}">
                        <label for="address" class="form-label">Address</label>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 form-floating">
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                        <label for="subject" class="form-label">Subject</label>
                        @error('subject')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 form-floating">
                        <textarea class="form-control" placeholder="message" id="message" name="message" style="height: 100px"></textarea>
                        <label for="message" class="form-label">Message</label>
                        @error('message')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-dark">Send</button>
                    </div>
                </form>
            </div>
            @else
            <div class="col-md-6 px-md-3 px-lg-5">
                <h2 class="f-3 mb-3"><span class="border-bottom border-primary-subtle">Feedback here</span></h2>
                <form class="row g-3 f-6" action="{{ route('feedbacks.store') }}" method="post">
                    @csrf
                    <div class="col-md-6 form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            value="{{ Auth::user()->email }}" disabled>
                        <label for="email" class="form-label">Email</label>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                            value="{{ Auth::user()->name }}" disabled>
                        <label for="name" class="form-label">Name</label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 form-floating">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address"
                            value="{{ Auth::user()->address }}" disabled>
                        <label for="address" class="form-label">Address</label>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 form-floating">
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                        <label for="subject" class="form-label">Subject</label>
                        @error('subject')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 form-floating">
                        <textarea class="form-control" placeholder="message" id="message" name="message" style="height: 100px"></textarea>
                        <label for="message" class="form-label">Message</label>
                        @error('message')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-dark">Send</button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
@endsection
