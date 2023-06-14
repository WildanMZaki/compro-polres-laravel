@extends('admin-layouts.master')

@section('content')

<!--begin::Page Vendor Stylesheets(used by this page)-->
<link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Page Vendor Stylesheets-->

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
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Tuliskan judul berita" id="newsTitle" value="{{ $isEdit? $berita->title: old('title') }}" autofocus required />

            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-5">
            @if ($isEdit)
                <label class="form-label fw-bold fs-3">Gambar sebelumnya:</label><br>
                <div class="d-flex flex-column align-items-center">
                    <img src="{{ asset('img/berita/'.$berita->image) }}" alt="Image Preview" class="img-fluid mb-5 mx-4 w-75 text-center"><br>
                    <h6 class="text-primary mb-5">Jangan upload gambar lain jika tidak ingin melakukan perubahan terhadap gambar</h6>
                </div>
            @endif
            <label for="newsImage" class="form-label fw-bold fs-3">{{ $isEdit? 'Atau upload gambar baru:': 'Upload gambar' }}</label>
            <input type="file" name="image" id="newsImage" class="form-control  @error('image') is-invalid @enderror" {{ $isEdit? '': 'required' }}>

            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-5">
            <label for="newsImage" class="form-label fw-bold fs-3">Tuliskan isi berita</label>
            <textarea name="content" id="my-editor" cols="30" rows="10" class="my-editor form-control @error('content') is-invalid @enderror" required>{{ $isEdit? $berita->content: old('content') }}</textarea>

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

<div class="row mt-10">
    <h2 class="mb-4">Image Manager</h2>
    <div class="row">
        <div class="col-xl-12">
            <div class="card py-5 px-4">
                <div class="row mb-6">
                    <form action="{{ route('simpan-gambar-berita') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="inputImages" class="form-label">Upload 1 atau lebih gambar untuk menambahkan konten gambar pada berita</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('gambar_berita') is-invalid @enderror" id="inputImages" name="gambar_berita[]" aria-describedby="inputGroupFileAddon04" aria-label="Upload" multiple required>
                            <button class="btn btn-success" type="submit" id="inputGroupFileAddon04">Upload gambar baru</button>
                        </div>

                        @error('gambar_berita')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </form>
                </div>
                <h5>Daftar gambar</h5>
                <table class="table border text-center table-striped table-row-bordered gy-5 gs-7" id="imageManager">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Preview</th>
                            <th>Nama Gambar</th>
                            <th>Get Link</th>
                        </tr>
                    </thead>
                    <tbody id="imgs_body">
                        @if (count($images))
                            @foreach ($images as $i => $image)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td class="w-25"><img src="{{ asset("img/berita/$image->name") }}" alt="Foto untuk berita" class="img-fluid"></td>
                                    <td>{{ $image->name }}</td>
                                    <td>
                                        <button class="btn btn-secondary text-primary copy-img-link" type="button" data-link="{{ asset("img/berita/$image->name") }}">
                                            <i class="bx bx-copy fs-3"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    {{-- Khusus Page Berita --}}

    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('my-editor');
    </script>
    <script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
	<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        "use strict";

        // Class definition
        var KTDatatableDemo = function () {

            // Public methods
            return {
                init: function () {
                }
            }
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTDatatableDemo.init();
        });
        $(document).ready(function(){
            $('#imageManager').DataTable();
        });

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };


        $('#imgs_body').on('click', '.copy-img-link',(e) => {
            const link = e.currentTarget.dataset.link;
            navigator.clipboard.writeText(link);
            toastr.success("Link sudah disalin");
        });
    </script>

@endpush
