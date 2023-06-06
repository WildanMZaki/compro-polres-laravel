@extends('admin-layouts.master')

@section('content')

@php
    $isEdit = isset($berita);
@endphp

<form action="{{ route(!$isEdit? 'simpan-berita': 'update-berita', $isEdit? $berita->slug: null) }}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($isEdit)
        @method('patch')
    @endif
<div class="row g-5 g-xl-8 mb-5">
    <div class="col-xl-10 offset-xl-1">
        <div class="mb-6">
            <label class="form-label fw-bold fs-3" for="satkerName">Judul Berita</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Tuliskan judul berita" id="newsTitle" value="{{ $isEdit? $berita->title: old('title') }}" autofocus />

            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-5">
            @if ($isEdit)
                <label class="form-label fw-bold fs-3">Gambar sebelumnya:</label><br>
                <img src="{{ asset('img/berita/'.$berita->image) }}" alt="Image Preview" class="img-fluid mb-5 mx-4 w-75 text-center"><br>
                <h6 class="text-primary mb-5">Jangan upload gambar lain jika tidak ingin melakukan terhadap gambar</h6>
            @endif
            <label for="newsImage" class="form-label fw-bold fs-3">{{ $isEdit? 'Atau upload gambar baru:': 'Upload gambar' }}</label>
            <input type="file" name="image" id="newsImage" class="form-control  @error('image') is-invalid @enderror">

            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-5">
            <label for="newsImage" class="form-label fw-bold fs-3">Tuliskan isi berita</label>
            {{-- <input type="hidden" name="content" id="newsContent">
            <div class="form-control p-5">
                <trix-editor input="newsContent"></trix-editor>
            </div> --}}
            <textarea name="content" id="my-editor" cols="30" rows="10" class="my-editor form-control @error('content') is-invalid @enderror">{{ $isEdit? $berita->content: old('content') }}</textarea>

            @error('content')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-10 offset-xl-1">
        <button type="submit" class="btn btn-primary">{{ $isEdit? 'Update': 'Post' }} <i class="bx bx-paper-plane"></i></button>
    </div>
</div>
</form>

@endsection

@push('scripts')
    {{-- Khusus Page Berita --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script> --}}

    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('my-editor');
    </script>

@endpush
