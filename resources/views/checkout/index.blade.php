@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold">
        <i class="bi bi-cart-check"></i> Checkout
    </h2>

    {{-- Pesan Error --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Jika keranjang kosong --}}
    @if($cartItems->isEmpty())
        <div class="alert alert-info">
            Keranjang kosong. <a href="{{ route('catalog.index') }}" class="fw-bold text-decoration-none">Belanja sekarang</a>
        </div>
    @else
        <div class="row g-4">
            {{-- Form Checkout (kiri) --}}
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-light fw-semibold">
                        Data Pengiriman
                    </div>
                    <div class="card-body">
                        <form action="{{ route('checkout.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="shipping_name" class="form-label">Nama Penerima</label>
                                <input type="text" name="shipping_name" id="shipping_name"
                                       class="form-control @error('shipping_name') is-invalid @enderror"
                                       value="{{ old('shipping_name', auth()->user()->name) }}" required>
                                @error('shipping_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="shipping_phone" class="form-label">No. HP</label>
                                <input type="text" name="shipping_phone" id="shipping_phone"
                                       class="form-control @error('shipping_phone') is-invalid @enderror"
                                       value="{{ old('shipping_phone', auth()->user()->phone) }}" required>
                                @error('shipping_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="shipping_address" class="form-label">Alamat Lengkap</label>
                                <textarea name="shipping_address" id="shipping_address" rows="3"
                                          class="form-control @error('shipping_address') is-invalid @enderror" required>{{ old('shipping_address', auth()->user()->address) }}</textarea>
                                @error('shipping_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="notes" class="form-label">Catatan (opsional)</label>
                                <textarea name="notes" id="notes" rows="2" class="form-control">{{ old('notes') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 fw-bold">
                                <i class="bi bi-credit-card"></i> Bayar & Buat Pesanan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Ringkasan Pesanan (kanan) --}}
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-light fw-semibold">
                        Ringkasan Pesanan
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush mb-3">
                            @foreach($cartItems as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>
                                        {{ $item->product?->name ?? 'Produk dihapus' }}
                                        <small class="text-muted">x {{ $item->quantity }}</small>
                                    </span>
                                    <span class="fw-semibold">
                                        Rp {{ number_format(($item->product?->price ?? 0) * $item->quantity, 0, ',', '.') }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-semibold">Ongkir</span>
                            <span>Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between fw-bold fs-5 border-top pt-2">
                            <span>Total</span>
                            <span>
                                Rp {{ number_format($subtotal + $shippingCost, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
