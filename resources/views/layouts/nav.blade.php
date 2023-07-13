<nav class="navbar navbar-expand-lg bg-body-secondary border-bottom border-info-subtle fixed-top shadow-sm">
  <div class="container-fluid container">
    <h1>
      <a href="{{ route('public.index') }}">
      <img src="{{ asset('images/img_bookhouse_logo.png') }}" alt="comida" class="logo">
      </a>
    </h1>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            @if (!empty(Auth::user()))
            @if (Auth::user()->role == 1)
            <li class="nav-item mx-3 fw-bold"><a href="{{ route('admin.dashboard') }}" class="nav-link active" aria-current="page">Dashboard</a></li>
            @else
            <li class="nav-item mx-3 fw-bold"><a href="{{ route('user.dashboard') }}" class="nav-link active" aria-current="page">Dashboard</a></li>
            @endif
            @endif
            <li class="nav-item mx-3 fw-bold"><a href="{{ route('public.index') }}" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item mx-3 fw-bold"><a href="{{ route('public.book') }}" class="nav-link">Book</a></li>
            <li class="nav-item mx-3 fw-bold"><a href="{{ route('public.ebook') }}" class="nav-link">Ebook</a></li>
            <li class="nav-item mx-3 fw-bold"><a href="{{ route('public.contact_us') }}" class="nav-link">Contact us</a></li>
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
    <div class="collapse navbar-collapse d-lg-flex justify-content-end" id="navbarSupportedContent">
        @if (empty(Auth::user()))
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item me-lg-2">
              <a href="{{ route('auth.loginPage') }}" class="btn btn-primary">Loign</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('auth.registerPage') }}" class="btn btn-primary">Register</a>
            </li>
          </ul>
        @else
         @if (Auth::user()->role == 1)
         <div class="dropdown col-6  float-right text-center">
            @if (Auth::user()->image == null)
            <img src="{{ asset('images/default.png') }}" alt="default" class="profile border border-white rounded-circle dropdown-toggle"
            type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
            @else
            <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="default" class="profile border border-white rounded-circle dropdown-toggle"
            type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
            @endif
            <ul class="dropdown-menu dropdown-menu-dark w-100" aria-labelledby="dropdownMenu2">
                <li><a href="{{ route('admin.details') }}" class="dropdown-item p-3">Profile</a></li>
                <li><a href="{{ route('admin.changePasswordPage') }}" class="dropdown-item p-3">Change Password</a></li>
                <li class="p-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item bg-primary text-white p-2 text-center rounded-pill" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
          @else
          <div class="dropdown col-6  float-right text-center">
            @if (Auth::user()->image == null)
            <img src="{{ asset('images/default.png') }}" alt="default" class="profile border border-white rounded-circle dropdown-toggle"
            type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
            @else
            <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="default" class="profile border border-white rounded-circle dropdown-toggle"
            type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
            @endif
            <ul class="dropdown-menu dropdown-menu-dark w-100" aria-labelledby="dropdownMenu2">
                <li><a href="{{ route('user.details') }}" class="dropdown-item p-3">Profile</a></li>
                <li><a href="{{ route('user.changePasswordPage') }}" class="dropdown-item p-3">Change Password</a></li>
                <li class="p-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item bg-primary text-white p-2 text-center rounded-pill" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
         @endif
        @endif
    </div>
  </div>
</nav>
