@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card pb-5 my-5 shadow">
                <div class="card-header mb-5 bg-edark text-warning text-center fs-3">{{ __('Verifikasi Alamat Email Anda') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Link verifikasi email yang baru telah terkirim ke email anda') }}
                        </div>
                    @endif

                    {{ __('Sebelum diproses, tolong periksa email anda untuk mendapatkan link verifikasi email.') }}
                    {{ __('Jika kamu tidak menerima email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Kirim ulang') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
