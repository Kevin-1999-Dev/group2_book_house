<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- bootstrap css --}}
    <link href="{{ asset('libs/bootstrap.min.css') }}" rel="stylesheet">
    {{-- bootstrap bundle --}}
    <script src="{{ asset('libs/bootstrap.bundle.min.js') }}"></script>
    {{-- Css --}}
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- jquery js --}}
    <script src="{{ asset('libs/jquery-3.7.0.min.js') }}"></script>
    {{-- chart js --}}
    <script src="{{ asset('libs/chart.js') }}"></script>
    {{-- heightline js --}}
    <script src="{{ asset('libs/jquery.heightLine.js') }}"></script>
    <script src="{{ asset('js/heightline.js') }}"></script>
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('libs/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('libs/select2-bootstrap-5-theme.min.css') }}" />
    <script src="{{ asset('libs/select2.full.min.js') }}"></script>
    {{-- axios --}}
    <script src="{{ asset('libs/axios.min.js') }}"></script>
    {{-- font-awesome --}}
    <link rel="stylesheet" href="{{ asset('libs/all.min.css') }}" />
</head>
<body>
    @include('layouts.nav')
    <div class="body-content">
        @yield('content')
    </div>
    <footer class="bg-body-secondary py-3 px-2 px-md-5 border-top border-danger-subtle">
        <div class="row d-flex align-items-center">
            <div class="col-4">
                <img src="{{ asset('images/img_bookhouse_logo.png') }}" alt="comida" class="f-logo">
            </div>
            <div class="col-8 text-end f-s text-secondary">
                &copy; 2023 All Right Reserved.
            </div>
        </div>
    </footer>
    @yield('script')
</body>
</html>
