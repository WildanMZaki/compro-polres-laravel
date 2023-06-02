@php
    $allMenu = [
        [
            'name' => 'Home',
            'route' => 'main'
        ],
        [
            'name' => 'Satker',
            'route' => 'satker'
        ],
        [
            'name' => 'Berita',
            'route' => 'berita'
        ],
        [
            'name' => 'Layanan',
            'route' => 'layanan'
        ],
        [
            'name' => 'Profile',
            'route' => 'profile'
        ],
    ]
@endphp

<header class="navbar navbar-dark bg-edark">
    <div class="container-fluid d-flex align-items-center">
        <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="{{ asset('img/blogo.png') }}" alt="" width="30" height="30" class="d-inline-block align-text-top">
        <p class="d-inline m-0 p-0 ms-4">POLRES SUBANG</p>
        </a>
        <nav class="w-50 m-0 header-nav">
        <ul class="d-flex list-unstyled ms-auto text-white justify-content-around m-0">
            @foreach ($allMenu as $menu)
                <li class="nav-item">
                    <a class="nav-link {{ ($menu['name'] == $active)? 'active': '' }}" aria-current="page" href="{{ route($menu['route']) }}">
                        <p class="m-0">{{ $menu['name'] }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
        </nav>
    </div>
</header>
