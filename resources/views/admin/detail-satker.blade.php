@extends('admin-layouts.master')

@section('content')

@php
    // $misi = json_decode($satker->misi);
    $links = [
        'instagram' => 'https://www.instagram.com/',
        'email' => 'mailto:',
        'whatsapp' => 'wa.me/',
        'facebook' => 'https://www.facebook.com/',
        'twitter' => 'https://www.twitter.com/',
    ];
@endphp

<main class="container">
    <div class="col-xl-10 offset-xl-1">
        <section class="row mb-5">
            <div class="col-12 d-flex justify-content-end">
                <a href="{{ route('detail-satker', $satker->slug) }}" class="me-3">
                    <button class="btn btn-outline-dark" type="button">
                        Lihat tampilan untuk user
                    </button>
                </a>
                <a href="{{ route('edit-satker', $satker->slug) }}" class="me-3">
                    <button class="btn btn-secondary" type="button">
                        Edit
                    </button>
                </a>
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirm_delete" data-slug="{{ $satker->slug }}" data-name="{{ $satker->name }}">
                    Hapus
                </button>
            </div>
        </section>
        <div class="satker card p-5">
            <div class="card-header d-flex justify-content-center mb-3 pb-3">
                <h1>{{ $satker->name }}</h1>
            </div>
            <section class="row mb-5">
                <div class="col-xl-4 offset-xl-4 col-6 offset-3 d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ asset('img/satker/'.$satker->image) }}" alt="Logo Satuan Kerja" class="img-fluid">
                </div>
            </section>
            <section class="satker-contacts row">
                <div class="col-xl-4 offset-xl-4 border-top py-2 col-6 offset-3 d-flex flex-column justify-content-{{ (count($satker->satker_contacts)>2)? 'between': 'center'}} align-items-center">
                    <h3>Hotlinks</h3>
                    @if (!count($satker->satker_contacts))
                        <div class="p-3 text-center">
                            <small class="text-muted">Tidak ada kontak disertakan</small>
                        </div>
                    @else
                        @foreach ($satker->satker_contacts as $contact)
                            <a href="{{ $links[$contact->type].$contact->contact}}" title="Contact Link" class="text-edark fs-4 p-2 border rounded mx-1">
                                <i class="fs-1 text-dark bx bxl-{{ $contact->type === 'email'? 'gmail': $contact->type }}"></i>
                            </a>
                        @endforeach
                    @endif
                </div>
            </section>
            <section class="satker-content row mb-5">
                <div class="row">
                    <h3 class="border-bottom">Deskripsi</h3>
                    <p>{{ $satker->deskripsi }}</p>
                </div>
                <div class="row">
                    <h3 class="border-bottom">Visi</h3>
                    <p>{{ $satker->visi }}</p>
                </div>
                <div class="row">
                    <h3 class="border-bottom">Misi</h3>
                    <div class="mx-3">
                        {!! $satker->misi !!}
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

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

@push('scripts')
    <script>
        $('#confirm_delete').on('show.bs.modal', e => {
            const data = e.relatedTarget.dataset;
            $('#satker_name_modal').html(data.name);
            $('#deleteSatkerForm').attr('action', (e.target.dataset.route).replace('#', data.slug));
        });
    </script>
@endpush
