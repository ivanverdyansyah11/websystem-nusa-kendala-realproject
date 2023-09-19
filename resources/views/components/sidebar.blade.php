<div class="sidebar">
    <div class="sidebar-scroll d-flex flex-column justify-content-between">
        <div class="d-flex flex-column align-items-center w-100">
            <a href="">
                <img src="{{ asset('assets/img/brand/brand-logo.svg') }}" class="img-fluid brand-logo" alt="Brand Logo"
                    draggable="false">
            </a>
            <div class="link-wrapper d-flex flex-column w-100">
                <a href="" class="menu-link d-flex flex-column {{ Request::is('dashboard*') ? 'active' : '' }}">
                    <div class="link-item d-flex align-items-center">
                        <div class="icon-sidebar-wrapper">
                            <div class="sidebar-icon dashboard-icon"></div>
                        </div>
                        <p>Dashboard</p>
                    </div>
                </a>
                <a href="" class="menu-link d-flex flex-column {{ Request::is('kendaraan*') ? 'active' : '' }}">
                    <div class="link-item d-flex align-items-center">
                        <div class="icon-sidebar-wrapper">
                            <div class="sidebar-icon kendaraan-icon"></div>
                        </div>
                        <p>Kendaraan</p>
                    </div>
                </a>
                <a href="" class="menu-link d-flex flex-column {{ Request::is('pelanggan*') ? 'active' : '' }}">
                    <div class="link-item d-flex align-items-center">
                        <div class="icon-sidebar-wrapper">
                            <div class="sidebar-icon pelanggan-icon"></div>
                        </div>
                        <p>Pelanggan</p>
                    </div>
                </a>
                <a href="" class="menu-link d-flex flex-column {{ Request::is('sopir*') ? 'active' : '' }}">
                    <div class="link-item d-flex align-items-center">
                        <div class="icon-sidebar-wrapper">
                            <div class="sidebar-icon sopir-icon"></div>
                        </div>
                        <p>Sopir</p>
                    </div>
                </a>
                <a href="" class="menu-link d-flex flex-column {{ Request::is('pemesanan*') ? 'active' : '' }}">
                    <div class="link-item d-flex align-items-center">
                        <div class="icon-sidebar-wrapper">
                            <div class="sidebar-icon pemesanan-icon"></div>
                        </div>
                        <p>Pemesanan</p>
                    </div>
                </a>
                <a href=""
                    class="menu-link d-flex flex-column {{ Request::is('pengembalian*') ? 'active' : '' }}">
                    <div class="link-item d-flex align-items-center">
                        <div class="icon-sidebar-wrapper">
                            <div class="sidebar-icon pengembalian-icon"></div>
                        </div>
                        <p>Pengembalian</p>
                    </div>
                </a>
                <a href="" class="menu-link d-flex flex-column {{ Request::is('servis*') ? 'active' : '' }}">
                    <div class="link-item d-flex align-items-center">
                        <div class="icon-sidebar-wrapper">
                            <div class="sidebar-icon servis-icon"></div>
                        </div>
                        <p>Servis</p>
                    </div>
                </a>
                <a href="" class="menu-link d-flex flex-column {{ Request::is('pajak*') ? 'active' : '' }}">
                    <div class="link-item d-flex align-items-center">
                        <div class="icon-sidebar-wrapper">
                            <div class="sidebar-icon pajak-icon"></div>
                        </div>
                        <p>Pajak</p>
                    </div>
                </a>
                <a href="" class="menu-link d-flex flex-column {{ Request::is('laporan*') ? 'active' : '' }}">
                    <div class="link-item d-flex align-items-center">
                        <div class="icon-sidebar-wrapper">
                            <div class="sidebar-icon laporan-icon"></div>
                        </div>
                        <p>Laporan</p>
                    </div>
                </a>
                <a href=""
                    class="menu-link d-inline-block d-lg-none flex-column {{ Request::is('pengguna*') ? 'active' : '' }}">
                    <div class="link-item d-flex align-items-center">
                        <div class="icon-sidebar-wrapper">
                            <div class="sidebar-icon pengguna-icon"></div>
                        </div>
                        <p>Pengguna</p>
                    </div>
                </a>
                <form class="w-100">
                    @csrf
                    <button type="submit"
                        class="menu-link w-100 d-inline-block d-lg-none flex-column {{ Request::is('logout*') ? 'active' : '' }}">
                        <div class="link-item d-flex align-items-center">
                            <div class="icon-sidebar-wrapper">
                                <div class="sidebar-icon logout-icon"></div>
                            </div>
                            <p>Logout</p>
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="hamburger d-flex d-lg-none justify-content-center align-items-center">
    <img src="{{ asset('assets/img/button/hamburger.svg') }}" alt="Hamburger Icon" class="img-fluid hamburger-icon">
</div>

<script>
    const sidebar = document.querySelector('.sidebar');
    const hamburger = document.querySelector('.hamburger');

    hamburger.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });
</script>