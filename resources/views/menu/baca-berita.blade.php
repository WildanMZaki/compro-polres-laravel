@extends('layouts.sub-master')

@section('content')

<style>
    /* * {border: solid red 1px} */
    #news-main-img img { height: 50vh; }
    .berita {
        cursor: pointer;
    }
    .berita:hover .judul-berita {
        border-bottom: solid 3px orange;
    }
    #contentBerita img {
        object-fit: contain;
    }
    .judul-berita, .tanggal-berita, .isi-berita {
        min-width: 90%;
        max-width: 90%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .commentator-photo {
        flex-basis: 12%;
    }
    .commentator-photo img {
        width: 100%;
        height: 50%;
        object-fit: cover;
    }
    .comment {
        flex-basis: 88%;
    }
    .comment-actions i, .comment-actions small { cursor: pointer; }
    @media (max-width: 660px) {
        #news-main-img img { width: 100%; height: auto; }
        .commentator-photo {
            flex-basis: 25% !important;
        }
        .commentator-photo img {
            width: 100%;
            height: 60%;
            object-fit: cover;
        }
        .comment {
            flex-basis: 82% !important;
        }
        main {
            margin-bottom: 80px;
        }
    }
</style>

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
                    <form action="{{ route('simpan-komentar', $berita->slug) }}" method="post">
                        @csrf
                        <div class="card shadow">
                            <div class="card-body">
                                <textarea class="form-control" id="comment" rows="3" placeholder="Tuliskan komentar" name="comment" required></textarea>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary" title="Kirim komentar">Kirim <i class="bx bx-paper-plane"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <!-- Daftar Komentar -->
            <section class="d-flex flex-column" id="commentList">
                @if (!count($comments))
                    <div class="p-5">
                        <p class="text-muted text-center">Belum ada komentar</p>
                    </div>
                @else
                    @foreach ($comments as $comment)
                        <div class="komentar d-flex mb-3 border-bottom py-2">
                            <div class="commentator-photo pt-2 px-3">
                                <img src="{{ asset('img/user/'.$comment->user->image) }}" alt="FK" class="img-fluid rounded-circle">
                            </div>
                            <div class="comment">
                                <p class="fw-bold m-0">{{ $comment->user->name }}
                                    @if ($comment->user->role !== 'user')
                                        <span class='badge bg-light text-primary'>{{ $comment->user->role }} <i class='bx bx-check-circle'></i></span>
                                    @endif
                                </p>
                                <small class="text-muted">{{ time_passed($comment->created_at) }}</small>
                                <p>{{ $comment->comment }}</p>
                                <div class="d-flex align-items-center comment-actions">
                                    <span class="me-2">
                                        <i id="likeBtn{{$comment->id}}" data-id="{{ $comment->id }}" data-link="{{ route('like-komentar', $comment->id) }}" data-token="{{ csrf_token() }}" class="bx bx-like me-2 cursor-pointer like {{ (isset($user))? ((count($comment->likes()->where('user_id', '=', $user->id)->get()))? 'text-primary': 'text-dark'): 'text-dark' }}"></i>
                                        <span id="likeComment{{$comment->id}}">{{ count($comment->likes) }}</span>
                                    </span>
                                    <span class="me-4">
                                        <i id="dislikeBtn{{$comment->id}}" data-id="{{ $comment->id }}" data-link="{{ route('dislike-komentar', $comment->id) }}" data-token="{{ csrf_token() }}" class="bx bx-dislike me-2 cursor-pointer dislike {{ (isset($user))? ((count($comment->dislikes()->where('user_id', '=', $user->id)->get()))? 'text-primary': 'text-dark'): 'text-dark' }}"></i>
                                        <span id="dislikeComment{{$comment->id}}">{{ count($comment->dislikes) }}</span>
                                    </span>
                                </div>
                            </div>
                            @if (isset($user))
                                @if ($comment->user->id === $user->id)
                                    <div class="option">
                                        <div class="d-flex flex-column justify-content-start">
                                            <div class="dropdown">
                                                <i class="bx bx-menu-alt-right comment-opt" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById(`deleteForm{{$comment->id}}`).submit()">Hapus Komentar</a>
                                                        <form id="deleteForm{{$comment->id}}" action="{{ route('hapus-komentar', $comment->id) }}" method="post">@csrf @method('delete')</form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endforeach
                @endif
            </section>
        </div>
        <div class="col-lg-4 px-4 my-3">
            <section>
                <h4>Baca juga:</h4>
                <div class="w-100 d-flex flex-column berita-lainnya">
                    @foreach ($other_news as $news)
                        @if ($news->id !== $berita->id)
                            <div class="berita d-flex border p-2 mb-3 w-100" onclick="location.href = `{{ route('baca-berita', $news->slug) }}`">
                                <div class="gambar-berita w-25 pe-2">
                                    <img src="{{ asset("img/berita/$news->image") }}" alt="Gambar Berita" class="img-fluid">
                                </div>
                                <div class="info-berita w-75 d-flex flex-column">
                                    <h6 class="m-0 judul-berita">{{ $news->title }}</h6>
                                    <small class="tanggal-berita my-2">
                                        <i class="bx bx-calendar"></i>{{ date_convert($news->created_at) }}
                                    </small>
                                    <small class="isi-berita">{!! Str::limit( strip_tags( $news->content ), 70 ) !!}</small>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</main>

@endsection

@push('scripts')
    <script>
        $('#contentBerita img').addClass('img-fluid');
    </script>
@endpush
