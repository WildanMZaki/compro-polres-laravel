@extends('layouts.master')

@section('content')

<main class="container mt-4">
    <div class="row align-items-center">
        <div class="col-lg-8 d-flex justify-content-between mb-3">
            <h4><span id="label">Semua Satker</span>: <span id="total">{{ count($satkers) }}</span></h4>
        </div>
        <div class="col-lg-4 mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari satuan kerja" aria-label="Cari satuan kerja" aria-describedby="button-addon2" id="searchBox">
            </div>
        </div>
    </div>
    <div class="row justify-content-center px-3">
        @if (!count($satkers))
            <div class="p-5 text-center">
                <p>Belum ada satuan kerja yang ditambahkan</p>
            </div>
        @else
            <div class="semua-satker col-12 d-flex flex-wrap">
                @foreach ($satkers as $satker)
                    <div class="p-lg-3 p-1 satker mb-3 text-center" onclick="location.href = `{{ route('detail-satker', $satker->slug) }}`">
                        <div class="border shadow py-2 rounded-3 h-100 w-100">
                            <div class="d-flex justify-content-center h-75 p-2 w-100 text-center">
                                <img src="{{ asset('img/'.($satker->image? "satker/$satker->image": 'blogo.png')) }}" alt="logo" class="img-fluid satker-img w-100">
                            </div>
                            <div class="d-flex justify-content-center">
                                <h6 class="m-0 p-0 satker-name">{{ $satker->name }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</main>

@endsection
