<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light pink-navbar">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2 text-pink"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-icon-hover position-relative" href="javascript:void(0)">
                    <i class="ti ti-bell-ringing text-pink"></i>
                    <div class="notification bg-pink rounded-circle"></div>
                </a>
            </li>
        </ul>

        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                {{-- 🔎 Form Search --}}
                <form action="{{ route('daftarproduk.index') }}" method="GET" class="d-flex me-3">
                    <input type="text" name="q" class="form-control form-control-sm border-pink"
                           placeholder="Search..." value="{{ request('q') }}">
                    <button type="submit" class="btn btn-pink btn-sm ms-2">
                        <i class="ti ti-search"></i>
                    </button>
                </form>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/images/profile/user-2.jpg') }}" alt="Profile"
                             width="35" height="35" class="rounded-circle border border-pink">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                         aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="{{ route('profile.edit') }}" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6 text-pink"></i>
                                <p class="mb-0 fs-3">My Profile</p>
                            </a>
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-mail fs-6 text-pink"></i>
                                <p class="mb-0 fs-3">My Account</p>
                            </a>
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-list-check fs-6 text-pink"></i>
                                <p class="mb-0 fs-3">My Task</p>
                            </a>

                            {{-- Tombol Logout --}}
                            <form action="{{ route('logout') }}" method="POST" class="mx-3 mt-2">
                                @csrf
                                <button type="submit" class="btn btn-outline-pink w-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <style>
        .pink-navbar {
            background: light;
        }

        .text-pink {
            color: #ff6fae !important;
        }

        .bg-pink {
            background-color: light;
        }

        .border-pink {
            border-color: #ff6fae !important;
        }

        .btn-pink {
            background: linear-gradient(90deg, #ff6fae, #ff9fcf);
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 6px 18px;
            transition: 0.3s;
        }

        .btn-pink:hover {
            opacity: 0.9;
        }

        .btn-outline-pink {
            border: 1px solid #ff6fae;
            color: #ff6fae;
            border-radius: 20px;
            padding: 6px 18px;
            transition: 0.3s;
            background: transparent;
        }

        .btn-outline-pink:hover {
            background: linear-gradient(90deg, #ff6fae, #ff9fcf);
            color: #fff;
        }

        .form-control.border-pink {
            border: 1px solid #ff6fae;
        }

        .dropdown-menu .dropdown-item i {
            margin-right: 10px;
        }

        .notification {
            width: 10px;
            height: 10px;
            position: absolute;
            top: 8px;
            right: 8px;
        }
    </style>
</header>
