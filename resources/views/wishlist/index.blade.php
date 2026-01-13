{{-- ================================================
FILE: resources/views/wishlist/index.blade.php
FUNGSI: Halaman wishlist user
THEME: Pink Elegant (Clean)
================================================ --}}

@extends('layouts.app')

@section('title', 'Wishlist Saya')

@section('content')

<style>
    :root {
        --pink-main: #ff4f9a;
        --pink-dark: #b1124d;
    }

    .text-pink {
        color: var(--pink-main);
    }

    .bg-pink {
        background: linear-gradient(135deg, #ff4f9a, #ff7fbf);
    }

    .btn-pink {
        background: var(--pink-main);
        color: #fff;
        border: none;
    }

    .btn-pink:hover {
        background: var(--pink-dark);
        color: #fff;
    }
</style>

<div class="container py-5">

    {{-- HEADER --}}
    <div class="d-flex align-items-center mb-4">
        <div class="bg-pink text-white rounded-circle d-flex align-items-center justify-content-center me-3"
             style="width: 55px; height: 55px;">
            <i class="bi bi-heart-fill fs-4"></i>
        </div>
        <div>
            <h3 class="mb-0 fw-bold">Wishlist Saya</h3>
            <small class="text-muted">
                Produk favorit yang kamu simpan 💖
            </small>
        </div>
    </div>

    {{-- CONTENT --}}
    @if($products->count())
        <div class="row row-cols-2 row-cols-md-4 g-4">
            @foreach($products as $product)
                <div class="col">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="mt-5 d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    @else
        {{-- EMPTY WISHLIST --}}
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="bi bi-heart text-pink" style="font-size: 80px;"></i>
            </div>
            <h4 class="fw-bold mb-2">Wishlist Kosong</h4>
            <p class="text-muted mb-4">
                Belum ada produk favorit yang kamu simpan.
            </p>
            <a href="{{ route('daftarproduk.index') }}" class="btn btn-pink btn-lg px-4">
                <i class="bi bi-bag-heart me-2"></i>Mulai Belanja
            </a>
        </div>
    @endif

</div>
@endsection
