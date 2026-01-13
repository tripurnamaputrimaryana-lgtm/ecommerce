{{-- ================================================
FILE: resources/views/partials/navbar.blade.php
FUNGSI: Navigation bar customer (Perfected Luxury Pink)
================================================ --}}

<nav class="navbar navbar-expand-lg sticky-top navbar-luxury-pink">
    <div class="container">

        {{-- Logo Luxury - Ikon Botol Parfum --}}
        <a class="navbar-brand d-flex align-items-center fw-bold brand-container"
           href="{{ route('home') }}">
            <div class="logo-icon me-2">
                <i class="bi bi-droplet-half"></i> {{-- Representasi esensi parfum --}}
            </div>
            <div class="brand-text-wrapper">
                <span class="brand-main">LUMEA</span>
                <span class="brand-sub">Maison de Parfum</span>
            </div>
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler border-0 shadow-none" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <i class="bi bi-list fs-2 text-deep-pink"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">

            {{-- Search Bar - Minimalist & Elegant --}}
            <form class="mx-auto search-wrapper"
                  action="{{ route('daftarproduk.index') }}" method="GET">
                <div class="input-group-pink">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" name="q"
                           class="form-control shadow-none"
                           placeholder="Cari aroma impianmu..."
                           value="{{ request('q') }}">
                </div>
            </form>

            {{-- Right Menu - Structured & Aligned --}}
            <div class="navbar-nav-wrapper">
                <ul class="navbar-nav align-items-center">
                    
                    {{-- Nav Link: Koleksi --}}
                    <li class="nav-item">
                        <a class="nav-link nav-luxury me-lg-3" href="{{ route('daftarproduk.index') }}">
                            Koleksi
                        </a>
                    </li>

                    @auth
                    {{-- Wishlist Icon --}}
                    <li class="nav-item">
                        <a class="nav-link icon-link position-relative px-2" href="{{ route('wishlist.index') }}">
                            <i class="bi bi-suit-heart"></i>
                            @if(auth()->user()->wishlists()->count())
                                <span class="luxury-badge">{{ auth()->user()->wishlists()->count() }}</span>
                            @endif
                        </a>
                    </li>

                    {{-- Cart Icon --}}
                    <li class="nav-item">
                        <a class="nav-link icon-link position-relative px-2" href="{{ route('cart.index') }}">
                            <i class="bi bi-bag"></i>
                            @php $cartCount = auth()->user()->cart?->items()->count() ?? 0; @endphp
                            @if($cartCount)
                                <span class="luxury-badge bg-deep-pink">{{ $cartCount }}</span>
                            @endif
                        </a>
                    </li>

                    {{-- User Profile Dropdown --}}
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle profile-trigger d-flex align-items-center p-0 shadow-none"
                           data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                            <div class="avatar-container">
                                <img src="{{ auth()->user()->avatar_url }}"
                                     alt="{{ auth()->user()->name }}">
                            </div>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-pink animated-dropdown mt-3">
                            <li class="dropdown-header py-3">
                                <small class="text-muted d-block text-uppercase letter-spacing-1">Profil Anda</small>
                                <span class="fw-bold fs-6 text-pink-darker">{{ auth()->user()->name }}</span>
                            </li>
                            <li><hr class="dropdown-divider mx-2"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2"></i> Akun Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                    <i class="bi bi-box2-heart me-2"></i> Pesanan Saya
                                </a>
                            </li>
                            
                            @if(auth()->user()->isAdmin())
                            <li><hr class="dropdown-divider mx-2"></li>
                            <li>
                                <a class="dropdown-item admin-link" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-shield-check me-2"></i> Admin Panel
                                </a>
                            </li>
                            @endif

                            <li><hr class="dropdown-divider mx-2"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger border-0 bg-transparent w-100 text-start">
                                        <i class="bi bi-power me-2"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                    @else
                    {{-- Guest Links --}}
                    <li class="nav-item">
                        <a class="nav-link nav-luxury" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-luxury-pink" href="{{ route('register') }}">
                            Daftar
                        </a>
                    </li>
                    @endauth

                </ul>
            </div> {{-- End Right Menu Wrapper --}}
        </div>
    </div>
</nav>

<style>
/* --- Font & Variables --- */
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Montserrat:wght@300;400;500;600&display=swap');

:root {
    --deep-rose: #d63384;
    --soft-pink: #fdeef4;
    --luxury-pink: #ff85c1;
    --dark-pink: #a02663;
    --letter-spacing: 2px;
}

.navbar-luxury-pink {
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(15px);
    border-bottom: 1px solid var(--soft-pink);
    padding: 10px 0;
    z-index: 1050;
}

/* --- Logo Section --- */
.logo-icon {
    font-size: 1.9rem;
    color: var(--deep-rose);
    line-height: 1;
}

.brand-main {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    letter-spacing: 4px;
    background: linear-gradient(90deg, #d63384, #ffb6d9);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    line-height: 0.9;
}

.brand-sub {
    font-family: 'Montserrat', sans-serif;
    font-size: 0.6rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: #999;
}

/* --- Search Bar --- */
.search-wrapper {
    max-width: 380px;
    width: 100%;
}

.input-group-pink {
    background: #fdf2f7;
    border-radius: 50px;
    padding: 5px 15px;
    border: 1px solid #fce4ec;
    display: flex;
    align-items: center;
    transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.input-group-pink:focus-within {
    border-color: var(--luxury-pink);
    background: #fff;
    box-shadow: 0 5px 20px rgba(214, 51, 132, 0.08);
}

.input-group-pink input {
    background: transparent;
    border: none;
    font-size: 0.85rem;
    font-family: 'Montserrat', sans-serif;
}

.search-icon { color: var(--luxury-pink); margin-right: 8px; }

/* --- Navigation & Icons Structure --- */
.navbar-nav-wrapper .navbar-nav {
    display: flex;
    align-items: center;
}

.nav-luxury {
    font-family: 'Montserrat', sans-serif;
    font-weight: 500;
    font-size: 0.85rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #333 !important;
}

.icon-link {
    font-size: 1.5rem;
    color: #444 !important;
    transition: 0.3s ease;
    display: flex;
    align-items: center;
}

.icon-link:hover {
    color: var(--deep-rose) !important;
    transform: translateY(-2px);
}

/* --- Badges --- */
.luxury-badge {
    position: absolute;
    top: 4px;
    right: -4px;
    background: var(--deep-rose);
    color: white;
    font-size: 0.6rem;
    min-width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50px;
    border: 2px solid white;
}

/* --- Avatar & Dropdown --- */
.avatar-container {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    border: 2px solid var(--soft-pink);
    padding: 2px;
    transition: 0.3s;
}

.avatar-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.avatar-container:hover {
    border-color: var(--luxury-pink);
}

.dropdown-pink {
    border: none;
    border-radius: 12px;
    box-shadow: 0 15px 45px rgba(0,0,0,0.1);
    min-width: 240px;
    overflow: hidden;
}

.dropdown-item {
    font-family: 'Montserrat', sans-serif;
    font-size: 0.9rem;
    padding: 12px 20px;
    transition: 0.2s;
}

.dropdown-item:hover {
    background-color: var(--soft-pink);
    color: var(--dark-pink);
    padding-left: 25px;
}

/* --- Buttons --- */
.btn-luxury-pink {
    background: linear-gradient(45deg, var(--deep-rose), var(--luxury-pink));
    color: white;
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    font-size: 0.8rem;
    letter-spacing: 1px;
    border-radius: 50px;
    padding: 10px 25px;
    border: none;
    transition: 0.3s;
}

.btn-luxury-pink:hover {
    box-shadow: 0 8px 20px rgba(214, 51, 132, 0.25);
    transform: translateY(-2px);
    color: white;
}

/* --- Helpers --- */
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 991.98px) {
    .navbar-nav { padding: 20px 0; gap: 15px; text-align: center; }
    .search-wrapper { max-width: 100%; margin: 15px 0; }
    .avatar-container { margin: 0 auto; }
}
</style>