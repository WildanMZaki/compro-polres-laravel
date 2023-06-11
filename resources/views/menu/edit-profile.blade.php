@extends('layouts.sub-master')

@section('content')

<style>
    .editPhoto {
        position: relative;
        right: 20%;
        cursor: pointer;
    }
    .editPhoto:hover {
        background-color: #404042;
        color: orange;
    }
    .editPhoto i {
        vertical-align: middle;
    }
    #profilePhoto { width: 200px; height: 200px; }
    @media (max-width: 660px) {
        .editPhoto {
            right: 10%;
        }
        #profilePhoto { width: 35%; height: auto; }
        main {
            margin-bottom: 100px;
        }
    }
</style>

<main class="container mt-3">
    <div class="row my-4 mx-lg-5 mx-2 py-4 px-3 border border-4 rounded-1 shadow">
        <section class="col-lg-5 picture d-flex justify-content-center align-items-center">
            <div class="d-flex justify-content-center align-items-end">
                <span class="p-2 bg-edark text-center rounded-circle bg-transparent">
                    <i class="bx bx-edit fs-4 text-warning m-0 invisible"></i>
                </span>
                <img src="{{ asset('img/user/'.$user->image) }}" alt="Profile Photo" id="profilePhoto" class="img-fluid border m-0 p-0 border-secondary border-2 rounded-circle">
                <span class="p-2 bg-edark editPhoto text-center rounded-circle" onclick="location.href = `{{ route('edit-foto')}}`">
                    <i class="bx bx-edit fs-4 text-warning m-0"></i>
                </span>
            </div>
        </section>
        <section class="col-lg-6">
            <form action="{{ route('update-profile', $user->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="mb-3">
                    <label for="namaInput" class="form-label">Nama</label>
                    <input type="text" class="form-control  @error('name') is-invalid @enderror" id="namaInput" placeholder="Nama anda" class="w-100" name="name" value="{{ $user->name }}">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="emailInput" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailInput" class="w-100" placeholder="name@example.com" name="email" value="{{ $user->email }}">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="noInput" class="form-label">No. Telepon</label>
                    <input type="number" class="form-control  @error('telepon_number') is-invalid @enderror" id="noInput" placeholder="621234567890" class="w-100" name="telepon_number" value="{{ $user->telepon_number }}">

                    @error('telepon_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Perbarui <i class="bx bxs-save"></i></button>
                </div>
            </form>
        </section>
    </div>

</main>

@endsection
