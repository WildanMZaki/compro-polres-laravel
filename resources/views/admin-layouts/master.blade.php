<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @includeIf('admin-layouts.links')

    @if (isset($styles))
        @foreach ($styles as $style)
            <link rel="stylesheet" href="{{ asset('css/'.$style.'.css') }}">
        @endforeach
    @endif
</head>
<body id="kt_body" class="header-tablet-and-mobile-fixed aside-enabled">
    {{-- Start Admin Layout --}}

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Aside-->
            <div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
                <!--begin::Aside Toolbarl-->
                <div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">
                    <!--begin::User-->
                    @includeIf('admin-layouts.aside.user')
                    <!--end::Aside user-->
                </div>
                <!--end::Aside Toolbarl-->
                <!--begin::Aside menu-->
                <div class="aside-menu flex-column-fluid">
                    <!--begin::Aside Menu-->
                    @includeIf('admin-layouts.aside.menu')
                    <!--end::Aside Menu-->
                </div>
                <!--end::Aside menu-->
            </div>
            <!--end::Aside-->

            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                    @includeIf('admin-layouts.header')
                <!--end::Header-->

                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            @yield('content')
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Content-->

                <!--begin::Footer-->
                    @includeIf('admin-layouts.footer')
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->

    {{-- Memanggil Online Scripts --}}
    @includeIf('admin-layouts.scripts')

    {{-- Memanggil Local scripts --}}
    @if (isset($scripts))
        @foreach ($scripts as $script)
            <script src="{{ asset("js/$script.js") }}"></script>
        @endforeach
    @endif

    @stack('scripts')
</body>
</html>
