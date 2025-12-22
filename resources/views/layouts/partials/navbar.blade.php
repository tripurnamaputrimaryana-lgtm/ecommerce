<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                    <i class="ti ti-bell-ringing"></i>
                    <div class="notification bg-primary rounded-circle"></div>
                </a>
            </li>
        </ul>

        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                {{-- 🔎 Form Search --}}
                <form action="{{ route('catalog.index') }}" method="GET" class="d-flex me-3">
                    <input type="text" name="q" class="form-control form-control-sm"
                           placeholder="Search..." value="{{ request('q') }}">
                    <button type="submit" class="btn btn-primary btn-sm ms-2">
                        <i class="ti ti-search"></i>
                    </button>
                </form>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/images/profile/user-2.jpg') }}" alt="Profile"
                             width="35" height="35" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                         aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="{{ route('profile.edit') }}" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-3">My Profile</p>
                            </a>
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-mail fs-6"></i>
                                <p class="mb-0 fs-3">My Account</p>
                            </a>
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-list-check fs-6"></i>
                                <p class="mb-0 fs-3">My Task</p>
                            </a>

                            {{-- Tombol Logout --}}
                            <form action="{{ route('logout') }}" method="POST" class="mx-3 mt-2">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary w-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
