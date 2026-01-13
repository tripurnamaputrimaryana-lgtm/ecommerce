@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

<style>
:root {
    --pink-main: #ff4f9a;
    --pink-soft: #fff3f8;
    --pink-dark: #b1124d;
    --border-soft: #f5c7dc;
}

/* ===== GLOBAL ===== */
body {
    background: linear-gradient(180deg, #fffafb, #fff);
}

.section-title {
    font-weight: 800;
    letter-spacing: -.4px;
}

/* ===== CARD ===== */
.card-soft {
    border-radius: 22px;
    border: 1px solid var(--border-soft);
    background: #fff;
}

/* ===== INPUT ===== */
.form-soft {
    border-radius: 16px;
    border: 1.5px solid var(--border-soft);
    padding: 14px 16px;
}

.form-soft:focus {
    border-color: var(--pink-main);
    box-shadow: 0 0 0 4px rgba(255,79,154,.15);
}

/* ===== ICON CIRCLE ===== */
.icon-soft {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: var(--pink-soft);
    color: var(--pink-main);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

/* ===== PRODUCT MINI ===== */
.product-mini {
    display: flex;
    align-items: center;
    gap: 14px;
}

.product-img {
    width: 58px;
    height: 58px;
    border-radius: 14px;
    border: 1px solid var(--border-soft);
    position: relative;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-img img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.qty {
    position: absolute;
    top: -8px;
    right: -8px;
    background: var(--pink-main);
    color: #fff;
    font-size: 11px;
    padding: 3px 7px;
    border-radius: 50%;
    font-weight: 700;
}

/* ===== BUTTON ===== */
.btn-pink {
    background: linear-gradient(135deg, #ff4f9a, #ff7fbf);
    color: #fff;
    border-radius: 18px;
    font-weight: 700;
    padding: 14px;
    border: none;
    transition: .35s ease;
}

.btn-pink:hover {
    background: linear-gradient(135deg, #ff2f86, #ff6ab2);
    transform: translateY(-2px);
    box-shadow: 0 14px 28px rgba(255,79,154,.45);
}

/* ===== SUMMARY ===== */
.total-box {
    background: linear-gradient(135deg, #fff3f8, #ffe1ef);
    border-radius: 18px;
    padding: 16px;
}
</style>

<div class="container py-5">

    {{-- HEADER --}}
    <div class="mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item">
                    <a href="{{ route('cart.index') }}" class="text-muted text-decoration-none">
                        Keranjang
                    </a>
                </li>
                <li class="breadcrumb-item active fw-bold text-pink">
                    Checkout
                </li>
            </ol>
        </nav>

        <h2 class="section-title mb-1">Checkout</h2>
        <p class="text-muted">Pastikan data pengiriman kamu sudah benar 💗</p>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="row g-4">

            {{-- LEFT : SHIPPING --}}
            <div class="col-lg-7">
                <div class="card-soft p-4">

                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-soft me-3">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Informasi Pengiriman</h5>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="small fw-bold text-muted">Nama Penerima</label>
                            <input type="text"
                                   name="name"
                                   value="{{ auth()->user()->name }}"
                                   class="form-control form-soft"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="small fw-bold text-muted">No. Telepon</label>
                            <input type="tel"
                                   name="phone"
                                   class="form-control form-soft"
                                   required>
                        </div>

                        <div class="col-12">
                            <label class="small fw-bold text-muted">Alamat Lengkap</label>
                            <textarea name="address"
                                      rows="3"
                                      class="form-control form-soft"
                                      required></textarea>
                        </div>
                    </div>

                </div>
            </div>

            {{-- RIGHT : SUMMARY --}}
            <div class="col-lg-5">
                <div class="card-soft p-4 sticky-top" style="top:2rem">

                    <h5 class="fw-bold mb-4">Ringkasan Pesanan</h5>

                    @php $total = 0; @endphp
                    @foreach($cart->items as $item)
                        @php
                            $price = $item->product->display_price;
                            $sub = $price * $item->quantity;
                            $total += $sub;
                        @endphp

                        <div class="product-mini mb-3">
                            <div class="product-img">
                                <img src="{{ $item->product->image_url }}">
                                <span class="qty">{{ $item->quantity }}</span>
                            </div>

                            <div class="flex-grow-1">
                                <div class="fw-semibold small text-truncate">
                                    {{ $item->product->name }}
                                </div>
                                <small class="text-muted">
                                    Rp {{ number_format($price,0,',','.') }}
                                </small>
                            </div>

                            <div class="fw-bold small">
                                Rp {{ number_format($sub,0,',','.') }}
                            </div>
                        </div>
                    @endforeach

                    <div class="total-box mt-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Subtotal</span>
                            <span class="fw-bold small">
                                Rp {{ number_format($total,0,',','.') }}
                            </span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Pengiriman</span>
                            <span class="fw-bold text-success small">Gratis</span>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold fs-5 text-pink">
                                Rp {{ number_format($total,0,',','.') }}
                            </span>
                        </div>
                    </div>

                    <button class="btn btn-pink btn-lg w-100 mt-4">
                        <i class="bi bi-lock-fill me-2"></i>
                        Bayar Sekarang
                    </button>

                    <p class="text-center small text-muted mt-3">
                        <i class="bi bi-shield-check text-success me-1"></i>
                        Pembayaran aman & terenkripsi
                    </p>

                </div>
            </div>

        </div>
    </form>
</div>
@endsection
