<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  {{-- Css --}}
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  {{-- bootstrap css --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  {{-- bootstrap bundle --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  {{-- google fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans+Semi+Condensed:wght@200;400;700&family=Ysabeau:wght@400;700&display=swap" rel="stylesheet">
  <style>
    a {
      text-decoration: none;
    }
  </style>
</head>

<body>
    @include('layouts.nav')
    <div class="body-content">
    @yield('content')
    </div>
</body>

<footer class="bg-body-secondary py-2 px-5">
    <div class="row">
      <div class="col-3 col-md-2 col-lg-1">
      <img src="{{ asset('images/img_bookhouse_logo.png') }}" alt="comida">
      </div>
      <div class="col-9 col-md-10 col-lg-11 text-end pt-2 pt-md-4">
        &copy; 2023 All Rignt Reserved.
      </div>
    </div>
</footer>
</html>
