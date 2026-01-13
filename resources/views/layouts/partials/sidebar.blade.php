{{-- ================================================
FILE: resources/views/partials/sidebar.blade.php
FUNGSI: Sidebar Admin (Luxury Maison Style)
================================================ --}}

<aside class="left-sidebar luxury-sidebar">
    <div>
        {{-- Logo Section --}}
        <div class="brand-logo d-flex align-items-center justify-content-between px-4 py-4">
            <a href="{{ url('/admin/dashboard') }}" class="text-nowrap logo-container">
                <div class="d-flex align-items-center">
                    <i class="bi bi-droplet-half me-2 logo-icon-admin"></i>
                    <div class="brand-text-admin">
                        <span class="main">LUMEA</span>
                        <span class="sub">ADMIN PANEL</span>
                    </div>
                </div>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer">
                <i class="bi bi-x-lg fs-6 text-deep-rose"></i>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="sidebar-nav scroll-sidebar px-3" data-simplebar>
            <ul id="sidebarnav">

                <li class="nav-small-cap mt-3 mb-2">
                    <span class="hide-menu text-uppercase letter-spacing-2 fw-semibold">Manajemen Utama</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                       href="{{ url('/admin/dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                        <span class="hide-menu">Dashboard Overview</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('admin/categories*') ? 'active' : '' }}"
                       href="{{ url('/admin/categories') }}">
                        <i class="bi bi-collection"></i>
                        <span class="hide-menu">Kategori Produk</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('admin/products*') ? 'active' : '' }}"
                       href="{{ url('/admin/products') }}">
                        <i class="bi bi-box-seam"></i>
                        <span class="hide-menu">Katalog Produk</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('admin/orders*') ? 'active' : '' }}"
                       href="{{ url('/admin/orders') }}">
                        <i class="bi bi-receipt-cutoff"></i>
                        <span class="hide-menu">Daftar Pesanan</span>
                    </a>
                </li>

                <li class="nav-small-cap mt-4 mb-2">
                    <span class="hide-menu text-uppercase letter-spacing-2 fw-semibold">Konfigurasi</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('home') }}">
                        <i class="bi bi-arrow-left-circle"></i>
                        <span class="hide-menu">Lihat Toko</span>
                    </a>
                </li>

            </ul>
        </nav>
    </div>

    <style>
        /* --- Import Font --- */
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400;500;600&display=swap');

        :root {
            --deep-rose: #d63384;
            --soft-pink-bg: #fffafa;
            --active-gradient: linear-gradient(135deg, #d63384 0%, #ff85c1 100%);
            --sidebar-width: 270px;
        }

        .luxury-sidebar {
            background: #ffffff;
            border-right: 1px solid rgba(214, 51, 132, 0.1);
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.02);
            transition: 0.3s;
        }

        /* --- Logo Admin --- */
        .logo-container { text-decoration: none; }
        
        .logo-icon-admin {
            font-size: 1.8rem;
            color: var(--deep-rose);
        }

        .brand-text-admin {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .brand-text-admin .main {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            letter-spacing: 3px;
            color: #333;
            font-weight: 700;
        }

        .brand-text-admin .sub {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.55rem;
            letter-spacing: 3px;
            color: var(--deep-rose);
            font-weight: 600;
        }

        /* --- Sidebar Links --- */
        .sidebar-nav ul .sidebar-item {
            margin-bottom: 5px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 12px 18px;
            border-radius: 12px;
            color: #5a6a85;
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            font-size: 0.9rem;
            transition: 0.3s all ease;
            text-decoration: none;
            margin: 0 10px;
        }

        .sidebar-link i {
            font-size: 1.2rem;
            margin-right: 12px;
            transition: 0.3s;
        }

        .sidebar-link:hover {
            background-color: var(--soft-pink-bg);
            color: var(--deep-rose);
            transform: translateX(5px);
        }

        /* --- Active State --- */
        .sidebar-link.active {
            background: var(--active-gradient) !important;
            color: #ffffff !important;
            box-shadow: 0 8px 20px rgba(214, 51, 132, 0.25);
            font-weight: 600;
        }

        .sidebar-link.active i {
            color: #ffffff !important;
        }

        /* --- Small Caps --- */
        .nav-small-cap {
            color: #adb5bd;
            font-size: 0.65rem;
            padding: 0 25px;
        }

        .letter-spacing-2 {
            letter-spacing: 2px;
        }

        .text-deep-rose {
            color: var(--deep-rose) !important;
        }

        /* Custom Scrollbar */
        .scroll-sidebar::-webkit-scrollbar {
            width: 4px;
        }
        .scroll-sidebar::-webkit-scrollbar-thumb {
            background: #eee;
            border-radius: 10px;
        }
    /* HILANGKAN WARNA BIRU SAAT DI-KLIK (FOCUS & ACTIVE) */
    .sidebar-link, 
    .sidebar-link:focus, 
    .sidebar-link:active, 
    .sidebar-link:focus-visible,
    button:focus,
    .logo-container:focus {
        outline: none !important;
        box-shadow: none !important;
        /* Menghilangkan warna biru di Chrome/Safari/Mobile */
        -webkit-tap-highlight-color: transparent !important; 
    }

    /* Memastikan saat item aktif tidak ada shadow biru */
    .sidebar-link.active {
        background: var(--active-gradient) !important;
        color: #ffffff !important;
        /* Ganti shadow biru menjadi shadow pink lembut sesuai tema */
        box-shadow: 0 8px 20px rgba(214, 51, 132, 0.25) !important;
    }

    /* Tambahan untuk mobile agar tidak ada overlay biru saat layar disentuh */
    * {
        -webkit-tap-highlight-color: transparent;
    }

    /* Efek saat diklik (tapi belum dilepas) tetap pink transparan, bukan biru */
    .sidebar-link:not(.active):active {
        background-color: rgba(214, 51, 132, 0.1) !important;
        color: var(--deep-rose) !important;
    }

    /* Jika Anda menggunakan framework Modernize/AdminMart, tambahkan ini */
    .sidebar-item.selected > .sidebar-link,
    .sidebar-item.selected > .sidebar-link.active {
        background: var(--active-gradient) !important;
        box-shadow: 0 8px 20px rgba(214, 51, 132, 0.25) !important;
    }
    </style>
</aside>