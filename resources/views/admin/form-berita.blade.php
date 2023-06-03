@extends('admin-layouts.master')

@section('content')

<style>
    trix-editor {
        min-height: 40vh;
    }
</style>

<form action="{{ route('simpan-berita') }}" method="post" enctype="multipart/form-data">
    @csrf
<div class="row g-5 g-xl-8 mb-5">
    <div class="col-xl-10 offset-xl-1">
        <div class="mb-6">
            <label class="form-label fw-bold fs-3" for="satkerName">Judul Berita</label>
            <input type="text" name="title" class="form-control" placeholder="Tuliskan judul berita" id="newsTitle" value="" />
        </div>
        <div class="mb-5">
            <label for="newsImage" class="form-label fw-bold fs-3">Upload gambar</label>
            <input type="file" name="image" id="newsImage" class="form-control">
        </div>
        <div class="mb-5">
            <label for="newsImage" class="form-label fw-bold fs-3">Tuliskan isi berita</label>
            <input type="hidden" name="content" id="newsContent">
            <div class="form-control p-5">
                <trix-editor input="newsContent"></trix-editor>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-10 offset-xl-1">
        <button type="submit" class="btn btn-primary">Post <i class="bx bx-paper-plane"></i></button>
    </div>
</div>
</form>

@endsection
