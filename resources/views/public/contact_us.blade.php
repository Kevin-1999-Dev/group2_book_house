@extends('layouts.master')
@section('title')
    Contact Us Page
@endsection
@section('content')
<div class="container-fluid py-5">
  <div class="row">
    <div class="col-md-6 px-md-3 px-lg-5">
      <div class="mb-2  mb-2 mb-md-4">
        <span class="mark-txt fs-3">We value your feedback!</span>
      </div>
      <p class="fs-5">We would love to hear from you and appreciate any thoughts, suggestions, or comments you have regarding our website. Your feedback helps us improve and enhance the overall experience for all. Please take a moment to share your feedback with us.</p>
      <p class="green-txt fs-5">Thank you for your support!</p>
    </div>
    <!-- Message -->
    <div class="col-md-6 px-md-3 px-lg-5">
      <div class="mb-3">
        <span class="fs-3 border-bottom border-primary-subtle">Feedback here</span>
      </div>
      <form class="row g-3" action="{{ route('feedbacks.store') }}" method="post">
        @csrf
        <div class="col-md-6 form-floating">
          <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{(old('email'))}}">
          <label for="email" class="form-label">Email</label>
          @error('email')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="col-md-6 form-floating">
          <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{(old('name'))}}">
          <label for="name" class="form-label">Name</label>
          @error('name')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="col-12 form-floating">
          <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{(old('address'))}}">
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
  </div>
</div>
@endsection
