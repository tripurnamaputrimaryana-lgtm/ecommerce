@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')

<style>
    :root {
        --pink-main: #ff4f9a;
        --pink-soft: #fff1f7;
        --pink-dark: #b1124d;
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

    .text-pink {
        color: var(--pink-main);
    }

    .table thead {
        background: var(--pink-soft);
    }

    .qty-input {
        width: 70px;
        border-radius: 10px;
    }
</style>

<div class="container py-5">

    {{-- HEADER --}}
    <div class="d-flex align-items-center mb-4">
        <div class="bg-pink text-white rounded-circle d-flex align-items-center justify-content-center me-3"
             style="width: 55px; height: 55px;">
            <i class="bi bi-cart3 fs-4"></i>
        </div>
        <div>
            <h3 class="mb-0 fw-bold">Keranjang Belanja</h3>
            <small class="text-muted">Periksa kembali produk sebelum checkout</small>
        </div>
    </div>

    @if(!empty($cartItems) && count($cartItems) > 0)
    <div class="row g-4">

        {{-- CART ITEMS --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-0">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr class="text-center">
                                <th class="text-start ps-4">Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th class="text-end pe-4">Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cartItems as $item)
                            @php $product = $item['product'] ?? null; @endphp
                            @if($product)
                            <tr>
                                {{-- PRODUCT --}}
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $product->image_url }}"
                                             class="rounded-3 me-3"
                                             width="70" height="70"
                                             style="object-fit: cover;">
                                        <div>
                                            <a href="{{ route('daftarproduk.show', $product->slug) }}"
                                               class="fw-semibold text-dark text-decoration-none">
                                                {{ Str::limit($product->name, 40) }}
                                            </a>
                                            <div class="small text-muted">
                                                <i class="bi bi-tags me-1"></i>{{ $product->category->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- PRICE --}}
                                <td class="text-center fw-medium">
                                    Rp {{ number_format($product->display_price, 0, ',', '.') }}
                                </td>

                                {{-- QUANTITY --}}
                                <td class="text-center">
                                    <form action="{{ route('cart.update', $item['id']) }}"
                                          method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number"
                                               name="quantity"
                                               value="{{ $item['quantity'] }}"
                                               min="1"
                                               max="{{ $product->stock }}"
                                               class="form-control form-control-sm text-center qty-input"
                                               onchange="this.form.submit()">
                                    </form>
                                </td>

                                {{-- SUBTOTAL --}}
                                <td class="text-end fw-bold text-pink pe-4">
                                    Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                </td>

                                {{-- REMOVE --}}
                                <td class="text-center">
                                    <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger rounded-circle"
                                                onclick="return confirm('Hapus produk dari keranjang?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- SUMMARY --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 90px;">
                <div class="card-header bg-pink text-white rounded-top-4">
                    <h5 class="mb-0">
                        <i class="bi bi-receipt me-2"></i>Ringkasan Belanja
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Produk</span>
                        <span>{{ $totalQuantity }} item</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Total Harga</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold fs-5">Total</span>
                        <span class="fw-bold fs-4 text-pink">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    <a href="{{ route('checkout.index') }}"
                       class="btn btn-pink w-100 btn-lg mb-2">
                        <i class="bi bi-credit-card me-2"></i>Checkout Sekarang
                    </a>

                    <a href="{{ route('daftarproduk.index') }}"
                       class="btn btn-outline-secondary w-100">
                        <i class="bi bi-arrow-left me-2"></i>Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>

    </div>

    @else
    {{-- EMPTY CART --}}
    <div class="text-center py-5">
        <div class="mb-4">
            <i class="bi bi-cart-x text-pink" style="font-size: 80px;"></i>
        </div>
        <h4 class="fw-bold">Keranjang Kosong</h4>
        <p class="text-muted mb-4">
            Yuk temukan produk favorit kamu 💕
        </p>
        <a href="{{ route('daftarproduk.index') }}" class="btn btn-pink btn-lg">
            <i class="bi bi-bag-heart me-2"></i>Mulai Belanja
        </a>
    </div>
    @endif

</div>
@endsection
