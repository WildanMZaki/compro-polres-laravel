@extends('layouts.master')

@section('content')
<main class="container myProfile mt-3">
    <div class="row my-4 mx-lg-5 mx-2 py-4 px-3 border border-4 rounded-1 shadow">
        <section class="row mb-4">
            <section class="col-lg-4 offset-lg-1 picture d-flex justify-content-center">
                <img src="{{ asset('img/anonim.jpg') }}" alt="Profile Photo" id="profilePhoto" class="img-fluid border m-0 p-0 border-secondary border-2 rounded-circle">
            </section>
            <section class="col-lg-5 ">
                <div class="border-bottom border-1 mb-3">
                    <h6 class="fw-bold">Nama:</h6>
                    <p class="m-0">Wildan M Zaki</p>
                </div>
                <div class="border-bottom border-1 mb-3">
                    <h6 class="fw-bold">Email:</h6>
                    <p class="m-0">wildanmzaki7@gmail.com</p>
                </div>
                <div class="border-bottom border-1 mb-3">
                    <h6 class="fw-bold">No. Telepon:</h6>
                    <p class="m-0">081234567890</p>
                </div>
            </section>
        </section>
        <section class="row">
            <div class="col-10 offset-1 d-flex justify-content-center align-items-center">
                <a href="./edit.html" class="text-decoration-none me-3">
                    <button type="button" class="btn btn-outline-dark">Edit</button>
                </a>
                <form action="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger" name="logout">Logout</button>
                </form>
            </div>
        </section>
    </div>

</main>
@endsection
