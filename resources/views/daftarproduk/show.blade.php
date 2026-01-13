
@extends('layouts.app')

@section('title', $product->name)

@section('content')

<style>
:root {
    --pink-main: #ff4f9a;
    --pink-soft: #fff1f7;
    --pink-dark: #b1124d;
}

body {
    background-color: #fffafb;
}

/* ===== BREADCRUMB ===== */
.breadcrumb a {
    color: var(--pink-main);
    text-decoration: none;
}

/* ===== IMAGE CARD ===== */
.product-image-card {
    border-radius: 26px;
    overflow: hidden;
}

.main-image {
    height: 420px;
    object-fit: contain;
    background: #fff;
}

.thumbnail img {
    transition: all .3s ease;
}

.thumbnail img:hover {
    transform: scale(1.08);
    border-color: var(--pink-main) !important;
}

/* ===== INFO CARD ===== */
.product-info-card {
    border-radius: 26px;
}

.price-main {
    color: var(--pink-main);
}

/* ===== BUTTONS ===== */
.btn-pink {
    background: linear-gradient(135deg, #ff4f9a, #ff7fbf);
    color: #fff;
    border-radius: 50px;
    font-weight: 600;
    box-shadow: 0 12px 26px rgba(255,79,154,.35);
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

/* ===== BADGE ===== */
.badge-pink {
    background: var(--pink-main);
}

/* ===== QTY ===== */
.qty-group .btn {
    border-radius: 50%;
}
</style>

<div class="container py-5">

    {{-- ================= BREADCRUMB ================= --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('daftarproduk.index') }}">Katalog</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('daftarproduk.index',['category'=>$product->category->slug]) }}">
                    {{ $product->category->name }}
                </a>
            </li>
            <li class="breadcrumb-item active">{{ Str::limit($product->name, 30) }}</li>
        </ol>
    </nav>

    <div class="row g-4">

        {{-- ================= IMAGE ================= --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm product-image-card">
                <div class="position-relative">
                    <img src="{{ $product->image_url }}"
                         id="main-image"
                         class="w-100 main-image"
                         alt="{{ $product->name }}">

                    @if($product->has_discount)
                        <span class="badge badge-pink position-absolute top-0 start-0 m-3 fs-6">
                            -{{ $product->discount_percentage }}%
                        </span>
                    @endif
                </div>

                @if($product->images->count() > 1)
                <div class="card-body">
                    <div class="d-flex gap-2 thumbnail overflow-auto">
                        @foreach($product->images as $image)
                            <img src="{{ asset('storage/'.$image->image_path) }}"
                                 class="rounded border"
                                 style="width:80px;height:80px;object-fit:cover;cursor:pointer"
                                 onclick="document.getElementById('main-image').src=this.src">
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- ================= INFO ================= --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm product-info-card h-100">
                <div class="card-body p-4">

                    {{-- CATEGORY --}}
                    <a href="{{ route('daftarproduk.index',['category'=>$product->category->slug]) }}"
                       class="badge bg-light text-dark mb-2 text-decoration-none">
                        {{ $product->category->name }}
                    </a>

                    {{-- TITLE --}}
                    <h2 class="fw-bold mb-3">{{ $product->name }}</h2>

                    {{-- PRICE --}}
                    <div class="mb-4">
                        @if($product->has_discount)
                            <div class="text-muted text-decoration-line-through">
                                {{ $product->formatted_original_price }}
                            </div>
                        @endif
                        <div class="h3 fw-bold price-main">
                            {{ $product->formatted_price }}
                        </div>
                    </div>

                    {{-- STOCK --}}
                    <div class="mb-4">
                        @if($product->stock > 10)
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle me-1"></i> Stok Tersedia
                            </span>
                        @elseif($product->stock > 0)
                            <span class="badge bg-warning text-dark">
                                <i class="bi bi-exclamation-triangle me-1"></i> Sisa {{ $product->stock }}
                            </span>
                        @else
                            <span class="badge bg-danger">
                                <i class="bi bi-x-circle me-1"></i> Stok Habis
                            </span>
                        @endif
                    </div>

                    {{-- ADD TO CART --}}
                    <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="row g-3 align-items-end">
                            <div class="col-auto">
                                <label class="form-label fw-semibold">Jumlah</label>
                                <div class="input-group qty-group" style="width:150px">
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="decrementQty()">-</button>
                                    <input type="number" name="quantity" id="quantity"
                                        value="1" min="1" max="{{ $product->stock }}"
                                        class="form-control text-center">
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="incrementQty()">+</button>
                                </div>
                            </div>
                            <div class="col">
                                <button class="btn btn-pink btn-lg w-100"
                                        @if($product->stock==0) disabled @endif>
                                    <i class="bi bi-cart-plus me-2"></i>
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- WISHLIST --}}
                    @auth
                    <button onclick="toggleWishlist({{ $product->id }})"
                            class="btn btn-outline-pink mb-4 wishlist-btn-{{ $product->id }}">
                        <i class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill' : 'bi-heart' }} me-2"></i>
                        {{ auth()->user()->hasInWishlist($product) ? 'Hapus dari Wishlist' : 'Tambah ke Wishlist' }}
                    </button>
                    @endauth

                    <hr>

                    {{-- DESCRIPTION --}}
                    <h6 class="fw-bold">Deskripsi Produk</h6>
                    <div class="text-muted mb-3">
                        {!! $product->description !!}
                    </div>

                    <div class="row small text-muted">
                        <div class="col-6 mb-2">
                            <i class="bi bi-box me-2"></i> Berat {{ $product->weight }} gram
                        </div>
                        <div class="col-6 mb-2">
                            <i class="bi bi-tag me-2"></i> SKU: PROD-{{ $product->id }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
function incrementQty(){
    const i=document.getElementById('quantity');
    if(parseInt(i.value)<parseInt(i.max)) i.value++;
}
function decrementQty(){
    const i=document.getElementById('quantity');
    if(parseInt(i.value)>1) i.value--;
}
</script>
@endpush

@endsection
