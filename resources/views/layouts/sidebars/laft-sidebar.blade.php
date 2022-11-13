<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none text-white" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    @if ($role_id == 1)
                        @include('layouts.sidebars.admin-sidebar')
                    @elseif ($role_id == 2)
                        @include('layouts.sidebars.company-sidebar')
                    @elseif ($role_id == 3)
                        @include('layouts.sidebars.manager-sidebar')
                    @elseif ($role_id == 4)
                        @include('layouts.sidebars.sels-executive-sidebar')
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>
