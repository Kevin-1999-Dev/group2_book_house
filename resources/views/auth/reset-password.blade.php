<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    {{-- bootstrap-css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- bootstrap-bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    {{-- Css --}}
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- google fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&display=swap"
        rel="stylesheet">
    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid">
        <div class="cmn-inner row py-3 py-lg-5">
            <a href="{{ route('public.index') }}" class="col-11 col-md-8 mx-auto f-5"> <i
                    class="fa-sharp fa-solid fa-arrow-left"></i>
                <h5 class="d-inline">Return Home Page</h5>
            </a>
            <div class="col-11 col-md-8 col-lg-6 mx-auto mt-2 mt-lg-5">
                <img class="col-2 d-block mx-auto mb-2 mb-lg-4" src="{{ asset('images/img_bookhouse_logo.png') }}"
                    alt="">
                <form action="{{ route('password.update') }}" method="POST"
                    class="shadow-lg p-3 p-md-5 border rounded">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="form-group mt-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                        @error('email')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                    <div class="form-group mt-3 f-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required
                            autocomplete="new-password">
                        @error('password')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>

                    <div class="form-group mt-3 f-6">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required
                            autocomplete="new-password">
                        @error('password_confirmation')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                    <div>
                        <input type="submit" value="{{ __('Reset Password') }}"
                            class="btn btn-sm btn-primary w-100 mt-3">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
