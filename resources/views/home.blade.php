{{-- ================================================
FILE: resources/views/home.blade.php
FUNGSI: Halaman utama website
THEME: Pink Elegant Premium (Hero Slider + Icon Category)
================================================ --}}

@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

<style>
:root {
    --pink-main: #ff4f9a;
    --pink-soft: #fff1f7;
    --pink-dark: #b1124d;
}

body { background-color: #fffafb; }
section { position: relative; }

h2 {
    font-weight: 800;
    color: var(--pink-dark);
    letter-spacing: -.6px;
}

.section-desc {
    color: #888;
    font-size: 15px;
}

/* ================= HERO ================= */
.pink-hero {
    position: relative;
    height: 90vh;
    min-height: 520px;
    overflow: hidden;
    color: #fff;
}

/* SLIDER */
.hero-slider {
    position: absolute;
    inset: 0;
    z-index: 1;
}

.hero-slide {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    opacity: 0;
    transform: scale(1.08);
    transition: opacity 1.2s ease, transform 6s ease;
}

.hero-slide.active {
    opacity: 1;
    transform: scale(1);
}

/* OVERLAY */
.hero-slider::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        rgba(255,79,154,.6),
        rgba(255,154,203,.6)
    );
}

/* CONTENT */
.hero-content {
    position: relative;
    z-index: 3;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.hero-title {
    font-family: 'Playfair Display', serif;
    font-size: 52px;
    font-weight: 600;
    margin-bottom: 18px;
    text-shadow: 0 10px 24px rgba(0,0,0,.35);
}

.hero-desc {
    font-size: 16px;
    line-height: 1.7;
    color: rgba(255,255,255,.95);
    max-width: 520px;
    margin: 0 auto 28px;
}

/* BUTTON HERO */
.btn-hero {
    background: linear-gradient(135deg, #ff4f9a, #ff7fbf);
    color: #fff;
    border-radius: 50px;
    padding: 14px 38px;
    font-size: 16px;
    font-weight: 600;
    box-shadow: 0 12px 28px rgba(255,79,154,.45);
    transition: all .35s ease;
}

.btn-hero:hover {
    background: linear-gradient(135deg, #ff2f86, #ff6ab2);
    transform: translateY(-3px);
    box-shadow: 0 18px 36px rgba(255,79,154,.55);
    color: #fff;
}

/* ================= CATEGORY ICON ================= */
.category-icon-card {
    border-radius: 22px;
    transition: all .35s ease;
}

.category-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 14px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ff4f9a, #ff7fbf);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 34px;
    box-shadow: 0 12px 26px rgba(255,79,154,.35);
}

.category-icon-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 36px rgba(0,0,0,.15);
}

.category-icon-card:hover .category-icon {
    transform: scale(1.08);
}

/* SECTION */
.featured-section {
    background: var(--pink-soft);
}

/* MOBILE */
@media (max-width: 768px) {
    .hero-title {
        font-size: 36px;
    }
}
</style>

{{-- ================= HERO ================= --}}
<section class="pink-hero">
    <div class="hero-slider" id="heroSlider">
        <div class="hero-slide active" style="background-image:url('/assets/images/4.jpg')"></div>
        <div class="hero-slide" style="background-image:url('/assets/images/2.jpg')"></div>
        <div class="hero-slide" style="background-image:url('/assets/images/5.jpg')"></div>
    </div>

    <div class="container hero-content">
        <div>
            <h1 class="hero-title">Belanja Premium & Elegan</h1>
            <p class="hero-desc">
                Pengalaman belanja dengan koleksi terpilih,
                kualitas terbaik, serta layanan terpercaya untuk Anda.
            </p>

            <a href="{{ route('daftarproduk.index') }}" class="btn btn-hero">
                <i class="bi bi-bag-heart me-2"></i>
                Mulai Berbelanja
            </a>
        </div>
    </div>
</section>

{{-- ================= KATEGORI (ICON) ================= --}}
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-2">Kategori Populer</h2>
        <p class="text-center section-desc mb-4">
            Kategori favorit pilihan pelanggan
        </p>

        @php
            $icons = [
                'floral'        => 'bi-flower1',
                'woody'         => 'bi-tree-fill',
                'oriental'      => 'bi-fire',
                'fresh-citrus'  => 'bi-brightness-high',
                'aquatic'       => 'bi-droplet-half',
                'gourmand'      => 'bi-cup-hot-fill',
            ];
        @endphp

        <div class="row g-4 justify-content-center">
            @foreach($categories as $category)
            @php
                $icon = $icons[$category->slug] ?? 'bi-brightness-high';
            @endphp

            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('daftarproduk.index',['category'=>$category->slug]) }}"
                   class="text-decoration-none">

                    <div class="card border-0 shadow-sm text-center h-100 category-icon-card">
                        <div class="card-body">
                            <div class="category-icon">
                                <i class="bi {{ $icon }}"></i>
                            </div>

                            <h6 class="fw-semibold text-dark mb-1">
                                {{ $category->name }}
                            </h6>

                            <small class="text-muted">
                                {{ $category->products_count }} produk
                            </small>
                        </div>
                    </div>

                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= PRODUK TERBARU ================= --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <span class="badge-soft">
                <i class="bi bi-stars me-1"></i>New Arrival
            </span>
            <h2 class="mt-2">Produk Terbaru</h2>
            <p class="section-desc">Koleksi parfum terbaru pilihan terbaik</p>
        </div>
        <div class="divider"></div>

        <div class="row g-4">
            @foreach($latestProducts as $product)
            <div class="col-6 col-md-4 col-lg-3 product-hover">
                @include('partials.product-card',['product'=>$product])
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= PRODUK UNGGULAN ================= --}}
<section class="py-5 featured-section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Produk Unggulan</h2>
            <a href="{{ route('daftarproduk.index') }}" class="btn btn-pink">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($featuredProducts as $product)
            <div class="col-6 col-md-4 col-lg-3">
                @include('partials.product-card',['product'=>$product])
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= JS SLIDER ================= --}}
<script>
const slides = document.querySelectorAll('.hero-slide');
let index = 0;

setInterval(() => {
    slides.forEach(s => s.classList.remove('active'));
    slides[index].classList.add('active');
    index = (index + 1) % slides.length;
}, 5000);
</script>

@endsection
