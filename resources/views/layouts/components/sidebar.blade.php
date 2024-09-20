<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/dashboard">GOR AMALIA INDAH</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fa-solid fa-fire"></i><span>General</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('dashboard') }}">Dashboard</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fa-solid fa-map"></i><span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/dashboard/admin') }}">Admin</a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/dashboard/user') }}">User</a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/dashboard/lapangan') }}">Lapangan</a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/dashboard/jadwal') }}">Jadwal</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <!-- <li class="menu-header">Data</li> -->
            <li class="nav-item dropdown">
                <a href="{{ url('/dashboard/daftar_booking') }}" class="nav-link"><i class=" fa-solid fa-database"></i><span>Booking</span></a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <!-- <li class="menu-header">Data</li> -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link"><i class=" fa-solid fa-database"></i><span>User Management</span></a>
            </li>
        </ul>
        <!-- <ul class="sidebar-menu">
            <li class="menu-header">PROFILE</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link"><i class="fa-solid fa-user"></i><span>Profile</span></a>
            </li>
        </ul> -->
    </aside>
</div>