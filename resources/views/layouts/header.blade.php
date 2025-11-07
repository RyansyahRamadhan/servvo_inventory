@php
    $username = auth()->check() ? auth()->user()->username : 'Guest';
    $role = auth()->check() ? auth()->user()->role : 'Guest';
@endphp

<nav class="sb-topnav navbar navbar-expand custom-navbar navbar-dark">
    <a class="navbar-brand ps-3" href="{{ route('dashboard') }}">WH-SERVVO</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown">
                <i class="fas fa-user fa-fw"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li class="dropdown-item"><strong>User:</strong> {{ $username }}</li>
                <li class="dropdown-item"><strong>Role:</strong> {{ $role }}</li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    @auth
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
                    @else
                        <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                    @endauth
                </li>
            </ul>
        </li>
    </ul>
</nav>
