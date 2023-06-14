@extends('admin-layouts.master')

@section('content')

<style>
    .gambar-layanan {
        height: 150px;
        object-fit: contain
    }
    .deskripsi-layanan {
        /* height: 512px; */
        overflow: hidden;
        text-overflow: ellipsis
    }
    .no-wr {
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
</style>

<main class="">
    <section class="row mb-5">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2>Semua layanan (<span id="totalLayanan">{{ count($layanans) }}</span>)</h2>
            <a href="{{ route('tambah-layanan') }}">
                <button class="btn btn-success">
                    <i class="bx bx-plus"></i> Tambah Layanan
                </button>
            </a>
        </div>
    </section>

    <section>
        @if (!count($layanans))
            <div class="row g-5 g-xl-8 my-5" id="nulllayanan">
                <div class="p-5 bg-light text-center">
                    <p class="text-muted fs-2 p-0 m-5">Hmm.. Belum ada layanan yang disediakan</p>
                    <a href="{{ route('tambah-layanan') }}">Sediakan layanan baru</a>
                </div>
            </div>
        @else
            <div class="row d-flex flex-wrap align-items-stretch" id="semua-layanan">
                @foreach ($layanans as $layanan)
                    <div class="{{ $layanan->deskripsi? 'col-xl-6': 'col-xl-3'}} layanan h-100 my-lg-0 my-2">
                        <!--begin::List Widget 7-->
                        <div class="card card-xl-stretch mb-xl-8 shadow h-100 flex-fill" title="{{ $layanan->name }}">
                            <!--begin::Header-->
                            <div class="card-header align-items-center border-0 mt-4">
                                <h3 class="card-title align-items-start flex-column w-75 overflow-hidden text-truncate">
                                    <span class="no-wr">
                                        {{ $layanan->name }}
                                    </span>
                                    <small class="no-wr"> {{ $layanan->visited? "Dipilih $layanan->visited kali": "Belum ada yang memilih" }}</small>
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
                                                <button type="button" class="btn btn-sm btn-light btn-light-primary me-2" data-kt-menu-dismiss="true" onclick="location.href = `{{ route('edit-layanan', $layanan->slug) }}`">Edit</button>
                                                <button type="button" class="btn btn-sm btn-danger" data-kt-menu-dismiss="true" data-bs-toggle="modal" data-bs-target="#confirm_delete" data-slug="{{ $layanan->slug }}" data-name="{{ $layanan->name }}">Hapus</button>
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
                            <div class="card-body p-5 row align-items-center">
                                <div class="{{ $layanan->deskripsi? 'col-lg-4': '' }} d-flex justify-content-center">
                                    <img src="{{ asset("img/layanan/$layanan->icon") }}" alt="Icon Layanan" class="gambar-layanan img-fluid mb-4">
                                </div>
                                @if ($layanan->deskripsi)
                                    <div class="col-lg-8">
                                        <p class="deskripsi-layanan">{{ Str::limit( $layanan->deskripsi, 250 ) }}</p>
                                    </div>
                                @endif
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::List Widget 7-->
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</main>

<div class="modal fade" tabIndex={-1} id="confirm_delete" data-route="{{ route('hapus-layanan', '#') }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Apakah anda yakin ingin menghapus layanan "<span id="nama_layanan"></span>"</h5>
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
          <form action="" method="post" id="deleteLayananForm">
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

@push('scripts')
    <script>
        $('#confirm_delete').on('show.bs.modal', e => {
            const data = e.relatedTarget.dataset;
            $('#nama_layanan').html(data.name);
            $('#deleteLayananForm').attr('action', (e.target.dataset.route).replace('#', data.slug));
        });
    </script>
@endpush
