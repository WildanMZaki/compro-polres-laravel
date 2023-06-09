@extends('admin-layouts.master')

@section('content')

<div class="row g-5 g-xl-8 mb-5 d-flex justify-content-between">
    <div class="col-xl-4">
        <h3>
            <span id="label">All</span> (<span id="number">{{ count($satkers) }}</span>)
        </h3>
    </div>
    <div class="col-xl-6 d-flex">
        <a href="{{ route('tambah-satker') }}" class="text-decoration-none">
            <button class="btn btn-success me-3 d-flex align-items-center">
                <i class="bx bx-plus"></i>
                <span>Tambah</span>
            </button>
        </a>
        <input type="text" class="form-control" id="searchBox" placeholder="Cari Satuan Kerja"/>
    </div>
</div>

@if (!count($satkers))
    <div class="row g-5 g-xl-8 my-5" id="nullSatker">
        <div class="p-5 bg-light text-center">
            <p class="text-muted fs-2 p-0 m-5">Hmm.. Belum ada satuan kerja yang ditambahkan</p>
            <a href="{{ route('tambah-satker') }}">Tambahkan Satuan Kerja</a>
        </div>
    </div>
@else
    <div class="row d-flex flex-wrap semua-satker">
        @foreach ($satkers as $satker)
            <div class="col-xl-4 col-6 satker my-3 cursor-pointer" onclick="location.href = `{{ route('prev-satker', $satker->slug) }}`">
                <div class="card card-custom card-flush d-flex flex-column align-items-center">
                    <div class="card-header d-flex justify-content-center">
                        <h3 class="card-title border-bottom pb-2 satker-name">{{ $satker->name }}</h3>
                    </div>
                    <div class="card-body py-5 d-flex flex-lg-column flex-row align-items-center justify-content-center satker-body">
                        <img src="{{ asset('img/'.((!$satker->image)? 'blogo.png': 'satker/'.$satker->image)) }}" alt="" class="img-fluid w-75">
                        <p class="h-25 satker-description text-center">{{ Str::limit( $satker->deskripsi, 60 ) }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-lg-end justify-content-center">
                        <a href="{{ route('edit-satker', $satker->slug) }}">
                            <button type="button" class="btn btn-sm btn-light me-2">
                                Edit
                            </button>
                        </a>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirm_delete" data-slug="{{ $satker->slug }}" data-name="{{ $satker->name }}">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

<div class="modal fade" tabIndex={-1} id="confirm_delete" data-route="{{ route('hapus-satker', '#') }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Apakah kamu yakin ingin menghapus satuan kerja "<span id="satker_name_modal"></span>"</h5>
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
        <form action="" method="post" id="deleteSatkerForm">
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
