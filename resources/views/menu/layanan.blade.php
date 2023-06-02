@extends('layouts.master')

@section('content')
<main class="container mt-3">
    <div class="row">
        <div class="col-10 offset-1">
            <div class="semua-layanan d-flex flex-wrap">
                <div class="p-lg-3 p-1 layanan">
                    <div class="border shadow py-3 rounded-3">
                        <div class="d-flex justify-content-center">
                            <i class="bx bx-id-card fs-1"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <small class="m-0 p-0">SIM</small>
                        </div>
                    </div>
                </div>
                <div class="p-lg-3 p-1 layanan">
                    <div class="border shadow py-3 rounded-3">
                        <div class="d-flex justify-content-center">
                            <i class="bx bx-file fs-1"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <small class="m-0 p-0">SKCK</small>
                        </div>
                    </div>
                </div>
                <div class="p-lg-3 p-1 layanan">
                    <div class="border shadow py-3 rounded-3">
                        <div class="d-flex justify-content-center">
                            <i class="bx bx-car fs-1"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <small class="m-0 p-0">STNK</small>
                        </div>
                    </div>
                </div>
                <div class="p-lg-3 p-1 layanan">
                    <div class="border shadow py-3 rounded-3">
                        <div class="d-flex justify-content-center">
                            <i class="bx bx-traffic-cone fs-1"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <small class="m-0 p-0">E-Tilang</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
