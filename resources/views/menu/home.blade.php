@extends('layouts.master')

@section('content')

<style>
    .service-img {
        height: 100px;
    }
    .service-img img {
        object-fit: contain
    }
</style>

<main class="container-fluid">
    <section id="hero">
        <div class="row text-dark hero-img">
            <div class="col-12 d-flex flex-column align-items-center">
                <img src="{{ asset('img/blogo.png')}} " alt="Logo Polres Subang">
                <i class="bg-warning p-1 rounded-1 mb-3">Profesional, Modern, Terpercaya</i>
            </div>
        </div>
        <div class="row">
            <div class="">
                <h2 class="py-3 px-5 text-lg-start text-center">Polres Subang</h2>
                <p class="container">Polres Subang adalah lembaga kepolisian yang selalu profesional dan terercaya. Kami melayani dengan tulus secara sigap dan cekatan.</p>
            </div>
        </div>
    </section>

    <section id="layanan" class="my-5">
        <div class="container">
            <div class="row mt-3">
                <h4 class="m-0">Layanan Kami</h4>
            </div>
            <div class="row py-3">
                @if (!count($layanans))
                    <div class="p-5 w-100">
                        <small>Maaf belum ada layanan disediakan</small>
                    </div>
                @else
                    @foreach ($layanans as $layanan)
                        <div class="col-lg-3 col-6 p-lg-3 p-1 layanan h-100">
                            <div class="card border shadow py-3 rounded-3 h-100"  onclick="location.href = `{{ route('dapatkan-layanan', $layanan->id) }}`">
                                <div class="card-body d-flex flex-column h-100">
                                    <div class="d-flex justify-content-center service-img mb-2">
                                        <img src="{{ asset("img/layanan/$layanan->icon") }}" alt="Icon Layanan" class="img-fluid w-50">
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <small class="m-0 p-0 fw-bold">{{ $layanan->name }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>

    <section id="satker-news" class="container">
        <div class="row">
            <!-- Section Satker -->
            <div class="col-lg-8">
                <div class="row mb-3">
                    <h4 class="m-0">Satuan Kerja</h4>
                </div>
                @if (!count($satkers))
                    <div class="w-100 text-center p-lg-5 p-4">
                        <p>Belum ada satuan kerja ditambahkan</p>
                    </div>
                @else
                    <div class="row semua-satker mb-4">
                        @foreach ($satkers as $satker)
                            <div class="p-lg-3 p-1" onclick="location.href = `{{ route('detail-satker', $satker->slug) }}`">
                                <div class="border shadow py-3 rounded-3 satker">
                                    <div class="d-flex justify-content-center px-3 pb-3 h-75">
                                        <img src="{{ asset('img/'.(($satker->image)? 'satker/'.$satker->image: 'blogo.png')) }}" alt="logo" class="img-fluid satker-img w-100">
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <h6 class="m-0 px-2 text-center satker-name">{{ $satker->name }}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Section Berita -->
            <div class="col-lg-4 my-lg-0 my-4">
                <div class="row mb-3">
                    <h4 class="m-0">Berita Terbaru</h4>
                </div>
                <div class="w-100 d-flex flex-column semua-berita">

                    @if (!count($beritas))
                        <div class="p-5 text-center">
                            Belum ada berita yang ditambahkan
                        </div>
                    @else
                        @foreach ($beritas as $berita)
                            <div class="berita d-flex border p-2 mb-3 shadow" onclick="location.href = `{{ route('baca-berita', $berita->slug) }}`">
                                <div class="gambar-berita w-25 pe-2">
                                    <img src="{{ asset('img/berita/'.$berita->image )}}" alt="Gambar Berita" class="img-fluid">
                                </div>
                                <div class="info-berita w-75 d-flex flex-column">
                                    <h6 class="m-0 judul-berita">{{ $berita->title }}</h6>
                                    <small class="tanggal-berita my-2">
                                        <i class="bx bx-calendar"></i>{{ date_convert($berita->created_at) }}
                                    </small>
                                    <small class="isi-berita">{!! Str::limit( strip_tags( $berita->content ), 40) !!}</small>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </section>
</main>


@stop
