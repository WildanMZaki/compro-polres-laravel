<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @includeIf('layouts.links')
    <style>
        #profilePhoto { min-height: 50vh; }
        @media (max-width: 1195px) {
            #profilePhoto { min-height: 25vh; }
        }
        @media (max-width: 660px) {
            #profilePhoto { max-height: 15vh; }
            main {
                margin-bottom: 100px;
            }
        }
    </style>
</head>
<body>

<main class="container">
    <div class="shadow mt-5 py-4 px-3">
        <div class="row text-center">
            <h1>Login</h1>
        </div>
        <div class="row mb-3 mx-lg-5 mx-2 align-items-center">
            <section class="col-lg-5 picture d-flex justify-content-center align-items-center">
                <div class="d-flex justify-content-center align-items-end">
                    <img src="{{ asset('img/blogo.png') }}" alt="Main Logo" id="profilePhoto" class="img-fluid">
                </div>
            </section>
            <section class="col-lg-6">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="emailInput" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Tuliskan email kamu">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <label for="pwdInput" class="form-label">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="TUliskan password kamu">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary">Login <i class="bx bx-log-in"></i></button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
                <div class="text-center">
                    <small class="text-center">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini!</a></small>
                </div>
            </section>
        </div>
    </div>

</main>

</body>
</html>
