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
            @foreach ($beritas as $berita)
                <div class="berita d-flex flex-lg-column border p-2 mb-lg-4 mb-3 mx-2 shadow rounded-1" onclick="location.href=`{{ route('baca-berita', $berita->slug) }}`">
                    <div class="gambar-berita p-lg-2 pe-2 text-center">
                        <img src="{{ asset('img/berita/'.$berita->image) }}" alt="Gambar Berita" class="img-fluid">
                    </div>
                    <div class="info-berita p-lg-2 d-flex flex-column justify-content-start">
                        <h6 class="m-0 judul-berita">{{ $berita->title }}</h6>
                        <small class="tanggal-berita my-2"> {{ date_convert($berita->created_at) }}
                            <i class="bx bx-calendar"></i>
                        </small>
                        <small class="isi-berita">{!! $berita->content !!}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>

@endsection
