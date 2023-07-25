<nav class="navbar navbar-expand-lg bg-body-secondary border-bottom border-danger-subtle fixed-top shadow-sm">
    <div class="container-fluid">
        <h1 class="mx-lg-5">
            <a href="{{ route('public.index') }}" class="me-2 me-md-4 me-lg-0">
                <img src="{{ asset('images/img_bookhouse_logo.png') }}" alt="Logo" class="logo">
            </a>
        </h1>
        <a class="btn btn-outline-dark btn-sm d-lg-none" href="{{ route('public.cart.index') }}">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge text-bg-danger px-1 py-0"
                id="totalItem">{{ isset(session('cart')['totalItem']) ? session('cart')['totalItem'] : '0' }}</span>
        </a>
        <span class="d-lg-none">
            @if (empty(Auth::user()))
                <span></span>
            @else
                @if (Auth::user()->role == 1)
                    <div class="dropdown d-inline">
                        @if (Auth::user()->image == null)
                            <img src="{{ asset('images/default.png') }}" alt="default"
                                class="profile border border-white rounded-circle dropdown-toggle" type="button"
                                id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        @else
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="default"
                                class="profile border border-white rounded-circle dropdown-toggle" type="button"
                                id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        @endif
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="dropdownMenu2">
                            <li><a href="{{ route('admin.details') }}" class="dropdown-item p-1 f-6">Profile</a></li>
                            <li><a href="{{ route('admin.changePasswordPage') }}" class="dropdown-item p-1 f-6">Change
                                    Password</a></li>
                            <li class="p-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item bg-primary text-white p-1 text-center rounded-3 f-6"
                                        type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="dropdown d-inline">
                        @if (Auth::user()->image == null)
                            <img src="{{ asset('images/default.png') }}" alt="default"
                                class="profile border border-white rounded-circle dropdown-toggle" type="button"
                                id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        @else
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="default"
                                class="profile border border-white rounded-circle dropdown-toggle" type="button"
                                id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        @endif
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="dropdownMenu2">
                            <li><a href="{{ route('user.details') }}" class="dropdown-item p-1 f-6">Profile</a></li>
                            <li><a href="{{ route('user.changePasswordPage') }}" class="dropdown-item p-1 f-6">Change
                                    Password</a></li>
                            <li class="p-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item bg-primary text-white p-1 text-center rounded-3 f-6"
                                        type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endif
            @endif
        </span>
        <button class="navbar-toggler btn p-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 f-5">
                @if (!empty(Auth::user()))
                    @if (Auth::user()->role == 1)
                        <li class="nav-item me-lg-4 fw-bold">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link" aria-current="page">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item me-lg-4 fw-bold">
                            <a href="{{ route('user.dashboard') }}" class="nav-link" aria-current="page">Dashboard</a>
                        </li>
                    @endif
                @endif
                <li class="nav-item me-lg-4 fw-bold">
                    <a class="nav-link" aria-current="page" href="{{ route('public.index') }}">Home</a>
                </li>
                <li class="nav-item me-lg-4 fw-bold">
                    <a class="nav-link" href="{{ route('public.book') }}">Book</a>
                </li>
                <li class="nav-item me-lg-4 fw-bold">
                    <a class="nav-link" href="{{ route('public.ebook') }}">Ebook</a>
                </li>
                <li class="nav-item me-lg-4 fw-bold">
                    <a class="nav-link" href="{{ route('public.contact_us') }}">Contact Us</a>
                </li>
                <li class="nav-item fw-bold d-none d-lg-block">
                    <a class="btn btn-outline-dark" href="{{ route('public.cart.index') }}">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge text-bg-danger"
                            id="totalItem">{{ isset(session('cart')['totalItem']) ? session('cart')['totalItem'] : '0' }}</span>
                    </a>
                </li>
                @if (!empty(Auth::user()))
                    @if (Auth::user()->role == 0)
                        <li class="nav-item mx-3 fw-bold d-none d-lg-block"><a href="{{ route('user.order.index') }}"
                                class="btn btn-dark"><i class="fa-sharp fa-solid fa-clock-rotate-left"></i> Order
                                History</a></li>
                        <li class="nav-item fw-bold d-lg-none">
                            <a class="nav-link" href="{{ route('user.order.index') }}"><i class="fa-sharp fa-solid fa-clock-rotate-left"></i> Order History</a>
                        </li>
                    @endif
                @endif
            </ul>
            <div class="d-flex me-lg-5">
                @if (empty(Auth::user()))
                    <a href="{{ route('auth.loginPage') }}" class="btn btn-primary nav-item me-2 d-none d-lg-inline-block">Login</a>
                    <a href="{{ route('auth.registerPage') }}" class="btn btn-primary nav-item d-none d-lg-inline-block">Register</a>
                    <a href="{{ route('auth.loginPage') }}" class="nav-item me-3 d-lg-none login fw-bold">Login</a>
                    <a href="{{ route('auth.registerPage') }}" class="nav-item d-lg-none float-end register fw-bold">Register</a>
                @else
                    @if (Auth::user()->role == 1)
                        <div class="dropdown d-none d-lg-block">
                            @if (Auth::user()->image == null)
                                <img src="{{ asset('images/default.png') }}" alt="default"
                                    class="profile border border-white rounded-circle dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                            @else
                                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="default"
                                    class="profile border border-white rounded-circle dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                            @endif
                            <ul class="dropdown-menu dropdown-menu-lg-end dropdown-menu-dark w-100"
                                aria-labelledby="dropdownMenu2">
                                <li><a href="{{ route('admin.details') }}" class="dropdown-item p-3">Profile</a></li>
                                <li><a href="{{ route('admin.changePasswordPage') }}"
                                        class="dropdown-item p-3">Change Password</a></li>
                                <li class="p-2">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button
                                            class="dropdown-item bg-primary text-white p-2 text-center rounded-pill"
                                            type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="dropdown d-none d-lg-block">
                            @if (Auth::user()->image == null)
                                <img src="{{ asset('images/default.png') }}" alt="default"
                                    class="profile border border-white rounded-circle dropdown-toggle" type="button"
                                    id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                            @else
                                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="default"
                                    class="profile border border-white rounded-circle dropdown-toggle" type="button"
                                    id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                            @endif
                            <ul class="dropdown-menu dropdown-menu-lg-end dropdown-menu-dark w-100"
                                aria-labelledby="dropdownMenu2">
                                <li><a href="{{ route('user.details') }}" class="dropdown-item p-3">Profile</a></li>
                                <li><a href="{{ route('user.changePasswordPage') }}" class="dropdown-item p-3">Change
                                        Password</a></li>
                                <li class="p-2">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button
                                            class="dropdown-item bg-primary text-white p-2 text-center rounded-pill"
                                            type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>
