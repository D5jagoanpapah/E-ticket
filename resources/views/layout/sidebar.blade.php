<style>
    .bg-gradient-primary {
    background-color: #800000; /* Warna maroon */
    background-image: none; /* Menghilangkan gradien */
}

.sidebar-dark .nav-link {
    color: #ffffff; /* Warna teks putih */
}

.sidebar-dark .nav-link:hover {
    background-color: #b30000; /* Warna saat hover */
}

.sidebar-dark .collapse-item {
    color: #ffffff; /* Warna teks untuk item collapse */
}

</style>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon">
        <img src="{{ asset('img/travel.png') }}" alt="Logo Primago Travel" style="width: 225px; height: 70px; object-fit: cover;">
    </div>
</a>


            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="home">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="/pakets">
                    <i class="fas fa-fw fa-box"></i> <!-- Ganti 'fa-table' dengan 'fa-box' -->
                    <span>Paket</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="/customers">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Pelanggan</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="/pemesanans">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Pemesanan</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="/pembayarans">
                    <i class="fas fa-fw fa-money-bill-alt"></i>
                    <span>Pembayaran</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a class="nav-link" href="/laporan">
                        <i class="fas fa-fw fa-print"></i>
                        <span>Cetak Laporan</span>
                    </a>
                @endif
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login">Login</a>
                        <a class="collapse-item" href="register">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                    </div>
                </div>
            </li>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
</div>
        </ul>