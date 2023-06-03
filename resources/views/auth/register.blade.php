<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
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
                <h1>Register</h1>
            </div>
            <div class="row mb-3 mx-lg-5 mx-2 ">
                <section class="col-lg-5 picture d-flex justify-content-center align-items-center">
                    <div class="d-flex justify-content-center align-items-end">
                        <img src="{{ asset('img/blogo.png') }}" alt="Profile Photo" id="profilePhoto" class="img-fluid">
                    </div>
                </section>
                <section class="col-lg-6">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="namaInput" class="form-label">Nama</label>

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama anda">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="emailInput" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="youremail@greatexample.com">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="noInput" class="form-label">No. Telepon</label>
                            <input type="number" name="telepon_number" class="form-control" id="noInput" placeholder="621234567890" class="w-100" required>
                        </div>

                        <div class="mb-4">
                            <label for="pwdInput" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Buat password yang kuat">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="pwdInput" class="form-label">Konfirmasi Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi password">
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary">Daftar <i class="bx bx-log-in"></i></button>
                        </div>
                    </form>
                    <div class="text-center">
                        <small class="text-center">Sudah punya akun? <a href="{{ route('login') }}">Log in di sini!</a></small>
                    </div>
                </section>
            </div>
        </div>

    </main>

</body>
</html>

