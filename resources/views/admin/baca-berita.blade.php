@extends('admin-layouts.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xl-10 offset-xl-1">

            <div class="row mb-10">
                <div class="c0l-12 w-100 d-flex justify-content-end">
                    <a href="{{ route('baca-berita', $berita->slug) }}" class="me-3">
                        <button type="button" class="btn btn-sm btn-secondary">Lihat tampilan untuk user</button>
                    </a>
                    @if ($user->id ===  $berita->user_id || $user->role === 'admin')
                        <a href="{{ route('edit-berita', $berita->slug) }}" class="me-3">
                            <button type="button" class="btn btn-sm btn-primary">Edit</button>
                        </a>
                        <button type="button" class="btn btn-sm btn-danger" data-kt-menu-dismiss="true" data-bs-toggle="modal" data-bs-target="#confirm_delete">Hapus</button>
                    @endif
                </div>
            </div>

            <div class="row text-center mb-4">
                <h1 class="judul-berita">{{ $berita->title }}</h1>
                <small class="tanggal-berita my-2">
                    <i class="bx bx-calendar"></i> {{ date_convert($berita->created_at) }}
                </small>
            </div>
            <div class="row text-center mb-10">
                <img src="{{ asset("img/berita/$berita->image") }}" alt="Gambar utama berita">
            </div>
            <div class="row mb-4">
                {!! $berita->content !!}
            </div>

        </div>
    </div>
</div>

<div class="modal fade" tabIndex={-1} id="confirm_delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Apakah kamu yakin ingin menghapus berita "{{ $berita->title }}"</h5>
          <div
            class="btn btn-icon btn-sm btn-active-light-primary ms-2"
            data-bs-dismiss="modal"
            aria-label="Close"
          >
          </div>
        </div>

        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Tidak
          </button>
          <form action="{{ route('hapus-berita', $berita->slug) }}" method="post" id="deleteBeritaForm">
              @csrf @method('delete')
              <button type="submit" class="btn btn-danger">
                Ya, hapus
              </button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
