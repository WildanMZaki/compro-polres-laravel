@php
    $allMenuFooter = [
        [
            'name' => 'Home',
            'route' => 'main',
            'icon_class' => 'bx bx-home'
        ],
        [
            'name' => 'Satker',
            'route' => 'satker',
            'icon_class' => 'bx bx-group'
        ],
        [
            'name' => 'Berita',
            'route' => 'berita',
            'icon_class' => 'bx bx-news'
        ],
        [
            'name' => 'Layanan',
            'route' => 'layanan',
            'icon_class' => 'bx bxs-dashboard'
        ],
        [
            'name' => 'Profile',
            'route' => 'profile',
            'icon_class' => 'bx bxs-user'
        ],
    ]
@endphp
<footer class="w-100 bg-edark ">
    <nav class="w-100">
        <ul class="list-unstyled d-flex w-100 justify-content-around my-3">
            @foreach ($allMenuFooter as $menu)
                <li class="{{ ($menu['name'] == $active)? 'active': '' }}">
                    <a href="{{ route($menu['route']) }}" class="footer-nav-link">
                        <i class='{{ $menu['icon_class'] }}'></i>
                        <small>{{ $menu['name'] }}</small>
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</footer>
