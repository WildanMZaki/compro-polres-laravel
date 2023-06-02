@extends('layouts.master')

@section('content')

<main class="container">
    <div class="row align-items-center mt-5">
        <div class="col-lg-6 mb-3">
            <h4>Berita</h4>
        </div>
        <div class="col-lg-6 mb-3 d-flex align-items-center">
            <select class="form-select form-select-lg py-1 w-25 me-2" aria-label=".form-select-lg example">
                <option selected disabled class="fs-6">Sort By</option>
                <option value="date">Date</option>
                <option value="visitor">Visitor</option>
                <option value="title">Title</option>
            </select>
            <div class="input-group m-0">
                <input type="text" class="form-control" placeholder="Cari berita" aria-label="Cari satuan kerja" aria-describedby="button-addon2" id="searchBox">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="semua-berita w-100 d-flex flex-lg-row flex-md-row flex-column justify-content-lg-start justify-content-md-start justify-content-center align-items-center mt-4 flex-lg-wrap flex-md-wrap">

        </div>
    </div>
</main>

@endsection
