@extends('layouts.sub-master')

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
    <div class="row m-lg-5 m-3 border p-3 shadow">
        <div class="col-lg-4 py-3 d-flex flex-column">
            <div class="satker-img d-flex justify-content-center mb-5">
                <img src="{{ asset('img/'.($satker->image? "satker/$satker->image": 'blogo.png')) }}" alt="Logo Satker " class="img-fluid w-50 border-bottom">
            </div>
            <div class="satker-hotline ">
                <h4 class="pb-2 border-bottom border-warning text-start">Hotline:</h4>
                <div class="contacts d-flex {{ count($satker->satker_contacts) > 3? 'justify-content-around': 'justify-content-center' }}">
                    @if (!count($satker->satker_contacts))
                        <div class="p-3 text-center">
                            <small class="text-muted">Tidak ada kontak disertakan</small>
                        </div>
                    @else
                        @foreach ($satker->satker_contacts as $contact)
                            <a href="{{ $links[$contact->type].$contact->contact}}" title="Contact Link" class="text-edark fs-4 p-2 border rounded mx-1">
                                <i class="bx bxl-{{ $contact->type === 'email'? 'gmail': $contact->type }}"></i>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-8 p-3">
            <div class="common mb-3">
                <h3>{{ $satker->name}}</h3>
                <p>{{ $satker->deskripsi}}</p>
            </div>
            <div class="vision">
               <h4>Visi</h4>
               <p>{{ $satker->visi }}</p>
            </div>
            <div class="mission">
                <h4>Misi</h4>
                {!! $satker->misi !!}
                {{-- @if ($misi->p)
                    <p>{{ $misi->p }}</p>
                @endif
                @if (count($misi->list))
                    <ol>
                        @foreach ($misi->list as $mi)
                            <li>{{ $mi }}</li>
                        @endforeach
                    </ol>
                @endif --}}
            </div>
        </div>
    </div>
</main>

@endsection

@push('h-scripts')
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/6469b2f874285f0ec46cb16b/1h0ue67g4';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
@endpush
