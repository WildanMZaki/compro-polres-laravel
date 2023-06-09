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

    {{-- Memanggil Online Scripts --}}
    @includeIf('layouts.scripts')

    @stack('h-scripts')
</head>
<body>

    {{-- Memanggil Header di ../views/layouts/header --}}
    @includeIf('layouts.sub-header')

    {{-- Content akan dipanggil berdasarkan view yang digunakan --}}
    @yield('content')

    {{-- Memanggil Local scripts --}}
    @if (isset($scripts))
        @foreach ($scripts as $script)
            <script src="{{ asset("js/$script.js") }}"></script>
        @endforeach
    @endif

    @stack('scripts')
</body>
</html>
