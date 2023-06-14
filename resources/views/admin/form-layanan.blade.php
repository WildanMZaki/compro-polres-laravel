@extends('admin-layouts.master')

@section('content')

@php $isEdit = isset($layanan)  @endphp

@if (count($errors))
    <h1>Ada error woy</h1>
@endif

<main class="container">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <h2 class="tect-center mb-7">{{ ($isEdit)? 'Edit Layanan': 'Tambahkan Layanan Baru' }}</h2>
            <form action="{{ route($isEdit? 'update-layanan': 'tambah-layanan', $isEdit? $layanan->slug: null) }}" method="post" enctype="multipart/form-data">
                @csrf
                @if ($isEdit)
                    @method('patch')
                @endif
                <div class="mb-4">
                    <label for="name" class="form-label">Nama Layanan</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required placeholder="Tuliskan nama layanan" value="{{ ($isEdit && !count($errors))? $layanan->name: old('name') }}">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="form-label">Deskripsi Layanan</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Tambahkan deskripsi layanan (opsional)">{{ ($isEdit && !count($errors))? $layanan->deskripsi: old('deskripsi') }}</textarea>

                    @error('deskripsi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="link" class="form-label">Link Layanan</label>
                    <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" id="link" required placeholder="Masukan link layanan" value="{{ ($isEdit && !count($errors))? $layanan->link: old('link') }}">

                    @error('link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="icon" class="form-label">Icon atau Foto Layanan</label>
                    <input type="file" class="form-control @error('icon') is-invalid @enderror" name="icon" id="icon" {{ $isEdit? '': 'required'}} placeholder="Masukan link layanan">

                    @error('icon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                @if ($isEdit)
                    <div class="mb-4 d-flex flex-column align-items-center">
                        <h5>Icon sebelumnya:</h5>
                        <img src="{{ asset("img/layanan/$layanan->icon") }}" alt="Icon Layanan Sebelumnya" style="max-height: 35vh;">
                        <p>Upload gambar baru untuk mengubahnya</p>
                    </div>
                @endif

                <div class="mb-4">
                    <button type="submit" class="btn btn-primary">{{ $isEdit? 'Perbarui': 'Tambahkan' }}</button>
                </div>
            </form>
        </div>
    </div>
</main>

@endsection
