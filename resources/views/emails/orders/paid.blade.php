{{-- resources/views/emails/orders/paid.blade.php --}}
@extends('layouts.app')

@section('title', 'Email Pesanan Dibayar')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-success">
        <i class="bi bi-envelope-check"></i> Konfirmasi Pembayaran
    </h2>

    <p>
        Halo, <strong>{{ $order->user->name }}</strong>! <br>
        Terima kasih, pembayaran untuk pesanan <strong>#{{ $order->order_number }}</strong> telah kami terima.
        Kami sedang memproses pesanan Anda.
    </p>

    {{-- Ringkasan Pesanan --}}
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header bg-light fw-semibold">
            Ringkasan Pesanan
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="fw-bold">
                        <td>Total</td>
                        <td></td>
                        <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tombol Detail Pesanan --}}
    <div class="mt-4">
        <a href="{{ route('orders.show', $order) }}" class="btn btn-primary fw-bold">
            <i class="bi bi-eye"></i> Lihat Detail Pesanan
        </a>
    </div>

    <p class="mt-3 text-muted">
        Jika ada pertanyaan, silakan balas email ini.
    </p>

    <p class="mt-2">
        Salam,<br>
        {{ config('app.name') }}
    </p>
</div>
@endsection
