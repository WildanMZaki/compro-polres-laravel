@extends('layouts.sub-master')

@section('content')

<main class="container">
    <div class="row my-lg-5 my-3 px-lg-5">
        <div class="col-lg-8">
            <!-- Headline dan tanggal -->
            <section class="mb-3 text-center">
                <h1 id="judulBerita">{{ $berita->title }}</h1>
                <small><i class="bx bx-calendar"></i> <span id="tanggalBerita">{{ date_convert($berita->created_at) }}</span></small>
            </section>
            <!-- Foto -->
            <section class="mb-3">
                <div id="news-main-img" class="d-flex justify-content-center">
                    <img src="{{ asset('img/berita/'.$berita->image) }}" alt="Gambar Utama Berita" class="img-fluid" id="gambarBerita">
                </div>
            </section>
            <!-- Isi Berita -->
            <section class="mb-5" id="contentBerita">
                {!! $berita->content !!}
            </section>

            <hr>
            <!-- Kirim komentar -->
            <section class="my-3 bg-light p-3 rounded-3">
                <div>
                    <h4>Komentar:</h4>
                </div>
                <div class="mb-3">
                    <form action="" method="post">
                        @csrf
                        <div class="card shadow">
                            <div class="card-body">
                                <textarea class="form-control" id="comment" rows="3" placeholder="Tuliskan komentar"></textarea>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary" title="Kirim komentar">Kirim <i class="bx bx-paper-plane"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <!-- Daftar Komentar -->
            <section class="d-flex flex-column">
                @if (!count($comments))
                    <div class="p-5">
                        <p class="text-muted text-center">Belum ada komentar</p>
                    </div>
                @else
                    @foreach ($comments as $comment)
                        <div class="komentar d-flex mb-3 border-bottom py-2">
                            <div class="commentator-photo pt-2 px-3">
                                <img src="./assets/anonim.jpg" alt="FK" class="img-fluid rounded-circle">
                            </div>
                            <div class="comment">
                                <p class="fw-bold m-0">Andi Maulana</p>
                                <small class="text-muted">1 jam yang lalu</small>
                                <p>Keren...</p>
                                <div class="d-flex align-items-center comment-actions">
                                    <span class="me-2">
                                        <i class="bx bx-like me-2"></i><span>8</span>
                                    </span>
                                    <span class="me-4">
                                        <i class="bx bx-dislike me-2"></i><span></span>
                                    </span>
                                    <span>
                                        <small class="text-muted">Balas</small>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </section>
        </div>
        <div class="col-lg-4 px-4 my-3">
            <section>
                <h4>Baca juga:</h4>
                <div class="w-100 d-flex flex-column berita-lainnya">

                </div>
            </section>
        </div>
    </div>
</main>

@endsection
