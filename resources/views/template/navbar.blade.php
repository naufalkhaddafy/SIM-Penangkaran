<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
        <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <ion-icon name="home"></ion-icon>
            <p>
                Dashboad
            </p>
        </a>
    </li>
    <li class="nav-header">EXAMPLES</li>
    <li class="nav-item {{ request()->is('dashboard') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->is('dashboar') ? 'active' : '' }}">
            <ion-icon name="home-outline"></ion-icon>
            <p>
                tes
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->is('dashboar') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard </p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="/user" class="nav-link {{ request()->is('user') ? 'active' : '' }}">
            <ion-icon name="person-sharp"></ion-icon>
            <p>
                Pengguna
            </p>
        </a>
    </li>
</ul>