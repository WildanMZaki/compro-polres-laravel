<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @includeIf('layouts.links')

    @if (isset($styles))
        @foreach ($styles as $style)
            <link rel="stylesheet" href="{{ asset('css/'.$style.'.css') }}">
        @endforeach
    @endif
</head>
<body>

    {{-- Memanggil Header di ../views/layouts/header --}}
    @includeIf('layouts.header')

    {{-- Content akan dipanggil berdasarkan view yang digunakan --}}
    @yield('content')

    {{-- Memanggil Footer --}}
    @includeIf('layouts.footer')

    {{-- Memanggil Online Scripts --}}
    @includeIf('layouts.scripts')

    {{-- Push Script here --}}
    @stack('scripts')

    {{-- Memanggil Local scripts --}}
    @if (isset($scripts))
        @foreach ($scripts as $script)
            <script src="{{ asset("js/$script.js") }}"></script>
        @endforeach
    @endif
</body>
</html>
