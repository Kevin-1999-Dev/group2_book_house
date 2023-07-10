<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- Css --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    {{-- bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- bootstrap bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- google fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&display=swap"
        rel="stylesheet">
</head>

<body>
    <section>
        <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                   <div class="container d-flex">
                    <h1 class=" navbar-brand">
                        <img src="{{ asset('images/img_bookhouse_logo.png') }}" alt="comida" class="logo">
                    </h1>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                   <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item mx-3 fw-bold"><a href="{{ route('auth.homePage') }}" class="nav-link active" aria-current="page">Dasboard</a></li>
                        <li class="nav-item mx-3 fw-bold"><a href="{{ route('public.book') }}" class="nav-link">Book</a></li>
                        <li class="nav-item mx-3 fw-bold"><a href="{{ route('public.ebook') }}" class="nav-link">Ebook</a></li>
                    </ul>
                   </div>
                   <div class="dropdown col-3 offset-1 float-right text-center">
                    <img src="{{ asset('images/male.png') }}" alt="default" class="w-25 rounded-circle dropdown-toggle"
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
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
