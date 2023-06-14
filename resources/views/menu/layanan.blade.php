@extends('layouts.master')

@section('content')

<style>
    .pointer {
        cursor: pointer;
    }
</style>

<main class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="row my-3">
                <h3>Semua layanan (<span id="totalService">0</span>)</h3>
            </div>
            <div class="semua-layanan row">
                @foreach ($layanans as $layanan)
                    <div class="col-lg-4 d-flex mb-2">
                        <div class="card shadow pointer" onclick="location.href = `{{ route('dapatkan-layanan', $layanan->id) }}`">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-lg-4 col-3 service-image">
                                        <img src="{{ asset("img/layanan/$layanan->icon") }}" alt="Icon Layanan {{ $layanan->name}}" class="img-fluid">
                                    </div>
                                    <div class="col-lg-8 col-9">
                                        <h4 class="p-0 m-0 mb-2">{{ $layanan->name }}</h4>
                                        <small class="text-edark p-2 mb-2 badge bg-warning">{{ $layanan->visited? "Dikunjungi $layanan->visited kali": 'Belum dikunjungi'}}</small>
                                    </div>
                                </div>
                                @if ($layanan->deskripsi)
                                    <div class="row">
                                        <p>{{ $layanan->deskripsi }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="col-lg-4 d-flex flex-column justify-content-around mb-2">
                    <div class="card shadow pointer mb-2">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-4 col-3 service-image">
                                    <img src="{{ asset('img/layanan/195866688013-06-2023_23--27--30.png') }}" alt="" class="img-fluid">
                                </div>
                                <div class="col-lg-8 col-9">
                                    <h4 class="p-0 m-0 mb-2">SIM</h4>
                                    <small class="text-edark p-2 mb-2 badge bg-warning">Dikunjungi 19 kali</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow pointer">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-4 col-3 service-image">
                                    <img src="{{ asset('img/layanan/195866688013-06-2023_23--27--30.png') }}" alt="" class="img-fluid">
                                </div>
                                <div class="col-lg-8 col-9">
                                    <h4 class="p-0 m-0 mb-2">SIM</h4>
                                    <small class="text-edark p-2 mb-2 badge bg-warning">Dikunjungi 19 kali</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
</main>

@endsection
