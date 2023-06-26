@extends('admin-layouts.master')

@section('content')

<!--begin::Row-->
<div class="row g-5 g-xl-8">

    @if ($user->role === 'admin')
        <div class="col-xl-6">
            <!--begin::Statistics Widget 5-->
            <a href="{{ route('admin-satker') }}" class="card bg-white hoverable card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                    <span class="svg-icon svg-icon-dark svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black" />
                            <path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="text-gray-900 text-dark fw-bolder fs-2 mb-2 mt-5">Satuan Kerja</div>
                    <div class="fw-bold text-gray-400 text-dark">{{ $satker_total? $satker_total: 'Belum ada' }} Satuan Kerja</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget 5-->
        </div>
    @endif

    <div class="col-xl-6">
        <!--begin::Statistics Widget 5-->
        <a href="{{ route('admin-berita') }}" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Svg Icon | path: icons/duotune/general/gen008.svg-->
                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z" fill="black" />
                        <path d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z" fill="black" />
                        <path opacity="0.3" d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z" fill="black" />
                        <path opacity="0.3" d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ $user->role === 'admin-berita'? 'Semua Berita': 'Berita' }}</div>
                <div class="fw-bold text-white">{{ $berita_total? $berita_total: 'Belum ada' }} Postingan, {{ $reader }} Pembaca</div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>

    @if ($user->role === 'admin-berita')
    <div class="col-xl-6">
        <!--begin::Statistics Widget 5-->
        <a href="{{ route('admin-berita') }}" class="card bg-secondary hoverable card-xl-stretch mb-xl-8">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Svg Icon | path: icons/duotune/general/gen008.svg-->
                <span class="svg-icon svg-icon-dark svg-icon-3x ms-n1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z" fill="black" />
                        <path d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z" fill="black" />
                        <path opacity="0.3" d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z" fill="black" />
                        <path opacity="0.3" d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <div class="text-dark fw-bolder fs-2 mb-2 mt-5">Berita yang anda posting</div>
                <div class="fw-bold text-dark">{{ $berita_saya? $berita_saya: 'Belum ada' }} Postingan, {{ $reader_saya }} Pembaca</div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>
    @endif
</div>
<!--end::Row-->
<!--begin::Row-->
<div class="row g-5 g-xl-8">

    @if ($user->role == 'admin')
        <div class="col-xl-6">
            <!--begin::Charts Widget 1-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Statistik Pengunjung</span>
                        <span class="text-muted fw-bold fs-7">More than 400 new members</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Chart-->
                    <div id="kt_charts_widget_1_chart" style="height: 350px"></div>
                    <!--end::Chart-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Charts Widget 1-->
        </div>
    @endif

    <div class="col-xl-6">
        <!--begin::List Widget 7-->
        <div class="card card-xl-stretch mb-xl-8">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="fw-bolder text-dark">Berita Terbaru</span>
                    <span class="text-muted mt-1 fw-bold fs-7">Articles and publications</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            @if (!count($berita_terbaru))
                <div class="text-center py-5">
                    <p>Belum ada berita yang dipublikasikan</p>
                    <a href="{{ route('tambah-berita') }}">Publikasikan berita baru</a>
                </div>
            @else
                <div class="card-body pt-3">
                    <!--begin::Items-->
                    @foreach ($berita_terbaru as $berita)
                        <div class="d-flex align-items-sm-center mb-7">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-60px symbol-2by3 me-4">
                                <div class="symbol-label" style="background-image: url('{{ asset("img/berita/".$berita->image) }}')"></div>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Title-->
                            <div class="d-flex flex-row-fluid flex-wrap align-items-center">
                                <div class="flex-grow-1 me-2">
                                    <a href="{{ route('preview-berita', $berita->slug) }}" class="text-gray-800 fw-bolder text-hover-primary fs-6">{{ $berita->title }}</a>
                                    <div class="d-flex flex-column">
                                        <span class="text-muted fw-bold d-block pt-1">{{ date_convert($berita->created_at) }}</span>
                                        <span class="fw-bold">Oleh: {{ $berita->reporter }}</span>
                                    </div>
                                </div>
                                <span class="badge badge-light-{{ ((!intval($berita->visitor))? 'danger': ((intval($berita->visitor) > 10)? 'success': 'warning')) }} fs-8 fw-bolder my-2">{{ $berita->visitor }} Pembaca</span>
                            </div>
                            <!--end::Title-->
                        </div>
                    @endforeach
                    <!--end::Items-->
                </div>
            @endif
            <!--end::Body-->
        </div>
        <!--end::List Widget 7-->
    </div>

    @if ($user->role === 'admin-berita')
        <div class="col-xl-6">
            <!--begin::List Widget 7-->
            <div class="card card-xl-stretch mb-xl-8">
                <!--begin::Header-->
                <div class="card-header align-items-center border-0 mt-4">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="fw-bolder text-dark">Berita Saya</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                @if (!count($my_news))
                    <div class="text-center py-5">
                        <p>Belum ada berita yang kamu publikasikan</p>
                        <a href="{{ route('tambah-berita') }}">Publikasikan berita baru</a>
                    </div>
                @else
                    <div class="card-body pt-3">
                        <!--begin::Items-->
                        @foreach ($my_news as $news)
                            <div class="d-flex align-items-sm-center mb-7">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-60px symbol-2by3 me-4">
                                    <div class="symbol-label" style="background-image: url('{{ asset("img/berita/".$news->image) }}')"></div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Title-->
                                <div class="d-flex flex-row-fluid flex-wrap align-items-center">
                                    <div class="flex-grow-1 me-2">
                                        <a href="{{ route('preview-berita', $news->slug) }}" class="text-gray-800 fw-bolder text-hover-primary fs-6">{{ $news->title }}</a>
                                        <span class="text-muted fw-bold d-block pt-1">{{ date_convert($news->created_at) }}</span>
                                    </div>
                                    <span class="badge badge-light-{{ ((!intval($news->visitor))? 'danger': ((intval($news->visitor) > 10)? 'success': 'warning')) }} fs-8 fw-bolder my-2">{{ $news->visitor }} Pembaca</span>
                                </div>
                                <!--end::Title-->
                            </div>
                        @endforeach
                        <!--end::Items-->
                    </div>
                @endif
                <!--end::Body-->
            </div>
            <!--end::List Widget 7-->
        </div>
    @endif
</div>
<!--end::Row-->

@endsection

<!--begin::Page Custom Javascript(used by this page)-->

@push('scripts')
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
@endpush

<!--end::Page Custom Javascript-->
