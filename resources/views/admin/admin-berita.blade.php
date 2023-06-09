@extends('admin-layouts.master')

@section('content')

<style>
    .berita:hover .judul-berita {
        border-bottom: rgb(117, 177, 233) solid 2px;
    }
    #semua-berita {
        align-items: stretch
    }

    .berita img {
        height: 200px;
        object-fit: fill;
        object-position: center;
    }
</style>

<div class="row g-5 g-xl-8 mb-5 d-flex justify-content-between">
    <div class="col-xl-4">
        <h3>
            <span id="label">All</span> (<span id="number">{{ count($beritas) }}</span>)
        </h3>
    </div>
    <div class="col-xl-6 d-flex">
        <div class="col-xl-3">
            <form action="{{ route('admin-berita') }}" method="get">
                <select class="form-select" aria-label="Select example" name="sort" onchange="event.target.parentElement.submit()">
                    <option value="created_at" {{ ($sort === 'created_at')? 'selected':'' }}>Tanggal</option>
                    <option value="visitor" {{ ($sort === 'visitor')? 'selected':'' }}>Visitor</option>
                    <option value="title" {{ ($sort === 'title')? 'selected':'' }}>Judul</option>
                </select>
            </form>
        </div>
        <div class="col-xl-9">
            <input type="text" class="form-control" id="searchBox" placeholder="Cari Berita"/>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-xl-12 d-flex justify-content-end">
        <a href="{{ route('tambah-berita') }}" class="text-decoration-none">
            <button class="btn btn-primary me-3 d-flex align-items-center">
                <i class="bx bx-plus"></i>
                <span>Post</span>
            </button>
        </a>
    </div>
</div>

@if (!count($beritas))
    <div class="row g-5 g-xl-8 my-5" id="nullberita">
        <div class="p-5 bg-light text-center">
            <p class="text-muted fs-2 p-0 m-5">Hmm.. Belum ada berita yang dipublikasikan</p>
            <a href="{{ route('tambah-berita') }}">Publikasikan berita baru</a>
        </div>
    </div>
@else
    <div class="row d-flex flex-wrap align-items-stretch" id="semua-berita">
        @foreach ($beritas as $berita)
            <div class="col-xl-4 berita cursor-pointer h-100 my-2">
                <!--begin::List Widget 7-->
                <div class="card card-xl-stretch mb-xl-8 shadow h-100 flex-fill">
                    <!--begin::Header-->
                    <div class="card-header align-items-center border-0 mt-4">
                        <h3 class="card-title align-items-start flex-column">
                            <a href="{{ route('preview-berita', $berita->slug) }}">
                                <span class="fw-bolder text-dark judul-berita">{{ $berita->title }}</span>
                            </a>
                            <span class="text-muted mt-1 fw-bold fs-7 tanggal-berita">{{ date_convert($berita->created_at) }}</span>
                        </h3>
                        <div class="card-toolbar">
                            <!--begin::Menu-->
                            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="bx bx-menu fs-1"></i>
                            </button>
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_6148588700dd8">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bolder">Opsi</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Menu separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Menu separator-->
                                <!--begin::Form-->
                                <div class="px-7 py-5">
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-sm btn-light btn-light-primary me-2" data-kt-menu-dismiss="true" onclick="location.href = `{{ route('edit-berita', $berita->slug) }}`">Edit</button>
                                        <button type="submit" class="btn btn-sm btn-danger" data-kt-menu-dismiss="true" data-bs-toggle="modal" data-bs-target="#confirm_delete" data-slug="{{ $berita->slug }}" data-title="{{ $berita->title }}">Hapus</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Form-->
                            </div>
                            <!--end::Menu 1-->
                            <!--end::Menu-->
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body p-5 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('img/berita/'.$berita->image)}}" alt="Gambar Berita" class="img-fluid rounded-3">
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::List Widget 7-->
            </div>
        @endforeach
    </div>
@endif

<div class="modal fade" tabIndex={-1} id="confirm_delete" data-route="{{ route('hapus-berita', '#') }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Apakah kamu yakin ingin menghapus berita "<span id="news_title"></span>"</h5>
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
          <form action="" method="post" id="deleteBeritaForm">
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
