<aside class="left-sidebar pink-sidebar">
    <!-- Sidebar scroll -->
    <div>
        <!-- Logo -->
        <div class="brand-logo d-flex align-items-center justify-content-between px-4 py-3">
            <a href="{{ url('/admin/dashboard') }}" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/lumea.png') }}" width="160" alt="Luméa" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-6 text-pink"></i>
            </div>
        </div>

        <!-- Sidebar navigation -->
        <nav class="sidebar-nav scroll-sidebar px-2" data-simplebar>
            <ul id="sidebarnav">

                <li class="nav-small-cap mt-2">
                    <i class="ti ti-dots nav-small-cap-icon fs-4 text-pink"></i>
                    <span class="hide-menu text-pink fw-semibold">Admin Menu</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ url('/admin/dashboard') }}">
                        <i class="ti ti-layout-dashboard"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('admin/categories*') ? 'active' : '' }}" href="{{ url('/admin/categories') }}">
                        <i class="ti ti-category"></i>
                        <span class="hide-menu">Kategori</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('admin/products*') ? 'active' : '' }}" href="{{ url('/admin/products') }}">
                        <i class="ti ti-package"></i>
                        <span class="hide-menu">Produk</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('admin/orders*') ? 'active' : '' }}" href="{{ url('/admin/orders') }}">
                        <i class="ti ti-receipt"></i>
                        <span class="hide-menu">Pesanan</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>

    <style>
        /* ===== SIDEBAR PINK THEME ===== */
        .pink-sidebar {
            background: #fff; /* Put background sesuai keinginan */
        }

        .text-pink {
            color: #ff6fae !important;
        }

        /* Sidebar Links */
        .sidebar-link {
            border-radius: 14px;
            padding: 12px 16px;
            margin: 6px 10px;
            color: #6c757d;
            font-weight: 600;
            transition: 0.3s;
        }

        .sidebar-link i {
            font-size: 1.2rem;
            margin-right: 10px;
        }

        /* Hover */
        .sidebar-link:hover {
            background: #ffe3f1;
            color: #ff6fae !important;
        }

        /* Active */
        .sidebar-link.active {
            background: linear-gradient(135deg, #ff6fae, #ff9fcf);
            color: #fff !important;
            box-shadow: 0 6px 18px rgba(255, 111, 174, .35);
        }

        .sidebar-link.active i {
            color: #fff !important;
        }

        /* Upgrade Card */
        .pink-upgrade {
            background: linear-gradient(135deg, #fff, #ffe3f1);
            padding: 16px;
        }

        .btn-pink {
            background: linear-gradient(90deg, #ff6fae, #ff9fcf);
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 6px 18px;
        }

        .btn-pink:hover {
            opacity: 0.9;
        }
    </style>
</aside>
