<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- Css --}}
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    {{-- bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- bootstrap bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <section>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div class="container d-flex">
                    <h1 class=" navbar-brand">
                        <a href="{{ route('public.index') }}">
                            <img src="{{ asset('images/img_bookhouse_logo.png') }}" alt="comida" class="logo">
                        </a>
                    </h1>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                   <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item mx-3 fw-bold"><a href="{{ route('user.dashboard') }}" class="nav-link active" aria-current="page">Dashboard</a></li>
                        <li class="nav-item mx-3 fw-bold"><a href="{{ route('public.index') }}" class="nav-link">Home</a></li>
                        <li class="nav-item mx-3 fw-bold"><a href="{{ route('public.book') }}" class="nav-link">Book</a></li>
                        <li class="nav-item mx-3 fw-bold"><a href="{{ route('public.ebook') }}" class="nav-link">Ebook</a></li>
                        <li class="nav-item mx-3 fw-bold"><a href="{{ route('public.contact_us') }}" class="nav-link">Contact Us</a></li>
                        <li class="nav-item ms-5 fw-bold">
                            <button type="button" class="btn btn-dark position-relative">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                  99+
                                  <span class="visually-hidden">unread messages</span>
                                </span>
                              </button>
                        </li>
                    </ul>
                   </div>
                   <div class="dropdown col-3 offset-1 float-right text-center">
                    <img src="{{ asset('images/female.jpg') }}" alt="default" class="w-25 mt-3 rounded-circle dropdown-toggle"
                        type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                    <ul class="dropdown-menu dropdown-menu-dark w-75" aria-labelledby="dropdownMenu2">
                        <li><a class="dropdown-item p-3">Profile</a></li>
                        <li><a class="dropdown-item p-3">Change Password</a></li>
                        <li class="p-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item bg-primary text-white p-2 text-center rounded-pill" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
                   </div>
                  </div>
          </nav>
    </section>
    @yield('content')
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
</body>
</html>
