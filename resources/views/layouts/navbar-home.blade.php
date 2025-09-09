<nav class="navbar navbar-expand-lg navbar-light navbar-fixed">
    <div class="container-fluid">
        <button class="navbar-toggle" id="sidebarToggleOutside" aria-label="Toggle sidebar">
            <i class="fas fa-bars"><span class="ms-3">Poslite</span></i>
        </button>
        <div class="d-flex align-items-center gap-3">
            {{-- <div class="dropdown">
                <a class="text-dark dropdown-toggle" data-bs-toggle="dropdown" href="#">ss</a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form method="POST">
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div> --}}
            <button class="btn rounded text-light" style="background-color: #9C2C77"><i class="fa-solid fa-store me-2"></i>Outlet 1</button>
            <button class="btn"><i class="fa-regular fa-calendar-days me-2"></i>{{ date('j F Y') }}</button>
            <a href="{{ route('login') }}" class="text-sm text-dark">Login</a>
        </div>
    </div>
</nav>
