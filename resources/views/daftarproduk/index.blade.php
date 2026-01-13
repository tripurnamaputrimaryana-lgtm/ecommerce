@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')

<style>
:root {
    --pink-main: #ff4f9a;
    --pink-soft: #fff1f7;
    --pink-dark: #b1124d;
    --gray-soft: #f8f8f8;
}

body {
    background-color: #fffafb;
}

/* ===== PAGE HEADER ===== */
.catalog-header {
    background: linear-gradient(135deg, #ff4f9a, #ff7fbf);
    color: #fff;
    border-radius: 26px;
    padding: 40px;
    margin-bottom: 40px;
    box-shadow: 0 20px 40px rgba(255,79,154,.35);
}

.catalog-header h2 {
    font-weight: 800;
}

.catalog-header p {
    opacity: .95;
}

/* ===== FILTER SIDEBAR ===== */
.filter-card {
    border-radius: 24px;
    overflow: hidden;
}

.filter-header {
    background: var(--pink-soft);
    color: var(--pink-dark);
    font-weight: 700;
    padding: 16px 20px;
}

.filter-body {
    padding: 20px;
}

.form-check-input:checked {
    background-color: var(--pink-main);
    border-color: var(--pink-main);
}

/* ===== BUTTON ===== */
.btn-pink {
    background: linear-gradient(135deg, #ff4f9a, #ff7fbf);
    color: #fff;
    border-radius: 50px;
    font-weight: 600;
}

.btn-pink:hover {
    background: linear-gradient(135deg, #ff2f86, #ff6ab2);
    color: #fff;
}

.btn-outline-pink {
    border: 1px solid var(--pink-main);
    color: var(--pink-main);
    border-radius: 50px;
}

.btn-outline-pink:hover {
    background: var(--pink-main);
    color: #fff;
}

/* ===== SORT ===== */
.sort-select {
    border-radius: 50px;
    padding-left: 16px;
}

/* ===== PRODUCT GRID ===== */
.product-wrap {
    transition: all .35s ease;
}

.product-wrap:hover {
    transform: translateY(-8px);
}

/* ===== EMPTY ===== */
.empty-box img {
    opacity: .6;
}
</style>

<div class="container py-5">

    {{-- ================= HEADER ================= --}}
    <div class="catalog-header text-center">
        <h2>Koleksi Produk Premium</h2>
        <p class="mb-0">
            Pilihan terbaik dengan kualitas elegan untuk melengkapi gaya Anda
        </p>
    </div>

    <div class="row">

        {{-- ================= FILTER ================= --}}
        <div class="col-lg-3 mb-4">
            <div class="card border-0 shadow-sm filter-card">
                <div class="filter-header">
                    <i class="bi bi-sliders me-2"></i>Filter Produk
                </div>
                <div class="filter-body">
                    <form action="{{ route('daftarproduk.index') }}" method="GET">

                        @if(request('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}">
                        @endif

                        {{-- KATEGORI --}}
                        <div class="mb-4">
                            <h6 class="fw-bold mb-2">Kategori</h6>
                            @foreach($categories as $cat)
                                <div class="form-check mb-1">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="category"
                                           value="{{ $cat->slug }}"
                                           {{ request('category') == $cat->slug ? 'checked' : '' }}
                                           onchange="this.form.submit()">
                                    <label class="form-check-label">
                                        {{ $cat->name }}
                                        <small class="text-muted">({{ $cat->products_count }})</small>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        {{-- HARGA --}}
                        <div class="mb-4">
                            <h6 class="fw-bold mb-2">Rentang Harga</h6>
                            <div class="d-flex gap-2">
                                <input type="number"
                                       name="min_price"
                                       class="form-control form-control-sm"
                                       placeholder="Min"
                                       value="{{ request('min_price') }}">
                                <input type="number"
                                       name="max_price"
                                       class="form-control form-control-sm"
                                       placeholder="Max"
                                       value="{{ request('max_price') }}">
                            </div>
                        </div>

                        <button class="btn btn-pink w-100 btn-sm mb-2">
                            Terapkan
                        </button>
                        <a href="{{ route('daftarproduk.index') }}"
                           class="btn btn-outline-pink w-100 btn-sm">
                            Reset
                        </a>
                    </form>
                </div>
            </div>
        </div>

        {{-- ================= PRODUCT ================= --}}
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0 text-dark">
                    Menampilkan {{ $products->total() }} Produk
                </h5>

                {{-- SORT --}}
                <form method="GET">
                    @foreach(request()->except('sort') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <select name="sort"
                            class="form-select form-select-sm sort-select"
                            onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                            Terbaru
                        </option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                            Harga Terendah
                        </option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                            Harga Tertinggi
                        </option>
                    </select>
                </form>
            </div>

            <div class="row row-cols-2 row-cols-md-3 g-4">
                @forelse($products as $product)
                    <div class="col product-wrap">
                        <x-product-card :product="$product" />
                    </div>
                @empty
                    <div class="col-12 text-center py-5 empty-box">
                        <img src="{{ asset('images/empty-state.svg') }}" width="170" class="mb-3">
                        <h5 class="fw-bold">Produk Tidak Ditemukan</h5>
                        <p class="text-muted">
                            Coba gunakan filter atau kata kunci lain
                        </p>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            <div class="mt-5">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@endsection
