<nav class="navbar navbar-expand-lg bg-body-secondary border-bottom border-info-subtle">
  <div class="container-fluid">
    <h1>
      <a href="{{ route('public.book') }}">
      <img src="{{ asset('images/img_bookhouse_logo.png') }}" alt="comida" class="logo">
      </a>
    </h1>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-lg-flex justify-content-end" id="navbarSupportedContent">
      @if (empty(Auth::user()))
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('public.book') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('public.book') }}">Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-lg-5" href="{{ route('public.ebook') }}">Ebooks</a>
        </li>
        <li class="nav-item me-lg-2 my-2 my-lg-0">
          <a href="{{ route('auth.loginPage') }}" class="btn btn-primary">Loign</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('auth.registerPage') }}" class="btn btn-primary">Register</a>
        </li>
      </ul>
      @else
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('public.book') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('public.book') }}">Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-lg-5" href="{{ route('public.book') }}">Ebooks</a>
        </li>
        <li class="nav-item me-lg-2">
          <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Dashboard</a>
        </li>
      </ul>
      @endif
    </div>
  </div>
</nav>