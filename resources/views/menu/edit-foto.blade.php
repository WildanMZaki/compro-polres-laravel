@extends('layouts.sub-master')

@section('content')

<main class="container mt-3">
    <div class="row my-4 mx-lg-5 mx-2 py-4 px-3 border border-4 rounded-1 shadow">
        <section class="col-lg-6 offset-lg-3 picture d-flex flex-column justify-content-center align-items-center">
            <div class="row mb-5">
                <div class="d-flex justify-content-center align-items-end">
                    <img src="{{ asset('img/user/'.$user->image) }}" alt="Profile Photo" id="profilePhoto" class="img-fluid border m-0 p-0 border-secondary border-2 rounded-circle">
                </div>
            </div>
            <div class="row mb-3">
                <form action="{{ route('terapkan-foto') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="input-group">
                        <input type="file" name="foto" class="form-control  @error('foto') is-invalid @enderror" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">

                        @error('foto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <button class="btn btn-outline-dark" type="submit" id="inputGroupFileAddon04">Terapkan</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <a href="{{ route('edit-profile') }}">
                    <button type="button" class="btn btn-secondary">Kembali</button>
                </a>
            </div>
        </section>
    </div>
</main>

@endsection
