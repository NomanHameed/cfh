<div class="container-fluid">
    <div class="d-flex d-lg-none me-2">
        <button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
            <i class="ph-list"></i>
        </button>
    </div>
    <div class="navbar-brand">
        <h3 class="m-0">
            <a href="{{ route('dashboard') }}" >
                Chicken Fried Hub
            </a>
        </h3>
    </div>
    <ul class="nav flex-row">
        <li class="nav-item d-lg-none">
            <a href="#navbar_search" class="navbar-nav-link navbar-nav-link-icon rounded-pill" data-bs-toggle="collapse">
                <i class="ph-magnifying-glass"></i>
            </a>
        </li>
    </ul>
    <ul class="nav flex-row justify-content-end order-1 order-lg-2">
        <li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
            <a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
                <div class="status-indicator-container">
                    <img src="{{ Auth::user()->image }}" class="w-32px h-32px rounded-pill" alt="">
                    <span class="status-indicator bg-success"></span>
                </div>
                <span class="d-none d-lg-inline-block mx-lg-2">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="{{ route('users.profileEdit') }}" class="dropdown-item">
                    <i class="ph-user-circle me-2"></i>
                    My profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a
                        href="{{ route('logout') }}"
                        class="dropdown-item"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="ph-sign-out me-2"></i>
                        Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</div>
