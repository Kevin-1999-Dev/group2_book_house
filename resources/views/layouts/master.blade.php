<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- bootstrap bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Css --}}
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- jquery js --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    {{-- chart js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- heightline js --}}
    <script src="{{ asset('libs/jquery.heightLine.js') }}"></script>
    <script src="{{ asset('js/heightline.js') }}"></script>
    {{-- select2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    {{-- axios --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    {{-- font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- google fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans+Semi+Condensed:wght@200;400;700&family=Ysabeau:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    @include('layouts.nav')
    <div class="body-content">
        @yield('content')
    </div>
    <footer class="bg-body-secondary py-3 px-2 px-md-5 border-top border-danger-subtle">
        <div class="row d-flex align-items-center">
            <div class="col-4">
                <img src="{{ asset('images/img_bookhouse_logo.png') }}" alt="comida" class="f-logo"><span class="d-none d-md-inline-block f-3"> BOOK HOUSE</span>
            </div>
            <div class="col-8 text-end f-s text-secondary">
                &copy; 2023 All Right Reserved.
            </div>
        </div>
    </footer>
    @yield('script')
</body>
</html>
