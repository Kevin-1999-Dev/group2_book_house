<nav class="navbar navbar-expand-lg bg-body-secondary">
  <div class="container-fluid">
    <h1>
          <img src="{{ asset('images/img_bookhouse_logo.png') }}" alt="comida" class="logo">
        </h1>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item mx-3 fw-bold"><a href="{{ route('auth.homePage') }}" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item mx-3 fw-bold"><a href="{{ route('public.book') }}" class="nav-link">Book</a></li>
            <li class="nav-item mx-3 fw-bold"><a href="#" class="nav-link">Ebook</a></li>
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
         <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item me-lg-2">
              <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Dashboard</a>
            </li>
          </ul>
          @else
          <div class="dropdown col-3 offset-1 float-right text-center">
            <img src="{{ asset('images/female.jpg') }}" alt="default" class="w-25 rounded-circle dropdown-toggle"
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
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item me-lg-2">
              <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Dashboard</a>
            </li>
          </ul>
         @endif
        @endif
    </div>
  </div>
</nav>
