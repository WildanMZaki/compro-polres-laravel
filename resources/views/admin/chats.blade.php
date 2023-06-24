@extends('admin-layouts.master')

@section('content')

    <main class="row">
        <h2>Live Chat</h2>
        <section class="col-12">
            <div class="embed-responsive embed-responsive-16by9 w-100">
                <iframe class="embed-responsive-item" src="https://dashboard.tawk.to/login" style="position:fixed;height:100%;width:80%;top:0;"></iframe>
            </div>
        </section>
    </main>

@endsection
