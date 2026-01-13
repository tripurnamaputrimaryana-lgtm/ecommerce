@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')

<style>
:root{
    --pink-main:#ff4f9a;
    --pink-soft:#fff1f7;
    --pink-dark:#b1124d;
    --pink-border:#f6c1da;
}

body{
    background: linear-gradient(180deg,#fffafd,#ffffff);
}

.text-pink{ color:var(--pink-main); }

.card-soft{
    border-radius:22px;
    border:1px solid var(--pink-border);
    overflow:hidden;
}

.table thead{
    background: var(--pink-soft);
}

.table th{
    font-size:14px;
    color:var(--pink-dark);
}

.total-box{
    background: linear-gradient(135deg,#fff1f7,#ffe1ef);
    border-radius:16px;
    padding:14px;
}

.btn-pink{
    background: linear-gradient(135deg,#ff4f9a,#ff7fbf);
    border:none;
    color:#fff;
    border-radius:18px;
    font-weight:700;
    padding:14px 36px;
    transition:.35s ease;
}

.btn-pink:hover{
    background: linear-gradient(135deg,#ff2f86,#ff6ab2);
    transform:translateY(-2px);
    box-shadow:0 14px 28px rgba(255,79,154,.45);
}

.icon-circle{
    width:48px;
    height:48px;
    border-radius:50%;
    background:var(--pink-soft);
    color:var(--pink-main);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
}
</style>

<div class="container py-5">
<div class="row justify-content-center">
<div class="col-lg-9">

<div class="card-soft shadow-sm bg-white">

{{-- HEADER --}}
<div class="p-4 border-bottom bg-white">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

        {{-- INFO ORDER --}}
        <div>
            <h4 class="fw-bold mb-1">
                Order
                <span class="text-pink">
                    #{{ $order->order_number }}
                </span>
            </h4>
            <small class="text-muted">
                {{ $order->created_at->format('d M Y, H:i') }}
            </small>
        </div>

        {{-- STATUS (SEBELAH ORDER) --}}
        @if($order->status === 'pending')
            <span class="badge rounded-pill px-4 py-2"
                  style="background:#fff0f6;color:#ff4f9a;border:1px solid #ffc1dc;">
                <i class="bi bi-hourglass-split me-1"></i>
                Menunggu Pembayaran
            </span>
        @elseif($order->status === 'processing')
            <span class="badge rounded-pill px-4 py-2 bg-primary">
                <i class="bi bi-arrow-repeat me-1"></i>
                Diproses
            </span>
        @elseif($order->status === 'success')
            <span class="badge rounded-pill px-4 py-2 bg-success">
                <i class="bi bi-check-circle me-1"></i>
                Berhasil
            </span>
        @endif

    </div>
</div>

{{-- STATUS PENDING BANNER --}}
@if($order->status === 'pending')
<div class="p-4 border-bottom" style="background:var(--pink-soft)">
    <div class="d-flex align-items-start gap-3">
        <div class="icon-circle">
            <i class="bi bi-hourglass-split"></i>
        </div>
        <div>
            <h6 class="fw-bold text-pink mb-1">
                Menunggu Pembayaran
            </h6>
            <p class="mb-0 text-muted small">
                Pesanan kamu telah dibuat dan menunggu pembayaran.
                Jika pembayaran berhasil, status akan otomatis berubah menjadi <b>Diproses</b>.
            </p>
        </div>
    </div>
</div>
@endif

{{-- PRODUK --}}
<div class="p-4">
    <div class="d-flex align-items-center mb-4">
        <div class="icon-circle me-3">
            <i class="bi bi-bag-heart"></i>
        </div>
        <h5 class="fw-bold mb-0">Produk Dipesan</h5>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Harga</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td class="fw-semibold">{{ $item->product_name }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-end">
                        Rp {{ number_format($item->price,0,',','.') }}
                    </td>
                    <td class="text-end fw-bold text-pink">
                        Rp {{ number_format($item->subtotal,0,',','.') }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="total-box mt-3">
        <div class="d-flex justify-content-between align-items-center">
            <span class="fw-bold fs-5">Total Bayar</span>
            <span class="fw-bold fs-4 text-pink">
                Rp {{ number_format($order->total_amount,0,',','.') }}
            </span>
        </div>
    </div>
</div>

{{-- ALAMAT --}}
<div class="p-4 border-top" style="background:var(--pink-soft)">
    <div class="d-flex align-items-center mb-3">
        <div class="icon-circle me-3">
            <i class="bi bi-geo-alt"></i>
        </div>
        <h5 class="fw-bold mb-0">Alamat Pengiriman</h5>
    </div>

    <p class="mb-1 fw-semibold">{{ $order->shipping_name }}</p>
    <p class="mb-1 text-muted">{{ $order->shipping_phone }}</p>
    <p class="mb-0">{{ $order->shipping_address }}</p>
</div>

{{-- BAYAR --}}
@if($order->status === 'pending' && !empty($snapToken))
<div class="p-4 text-center border-top bg-white">
    <p class="text-muted mb-3">
        <i class="bi bi-clock-history me-1"></i>
        Selesaikan pembayaran untuk melanjutkan pesanan
    </p>

    <button id="pay-button" class="btn btn-pink btn-lg">
        <i class="bi bi-lock-fill me-2"></i>Bayar Sekarang
    </button>
</div>
@endif

</div>
</div>
</div>
</div>
@endsection

{{-- MIDTRANS --}}
@push('scripts')
@if(!empty($snapToken))
<script src="{{ config('midtrans.snap_url') }}"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.getElementById('pay-button')?.addEventListener('click', function () {

    snap.pay('{{ $snapToken }}', {

        onSuccess() {
            window.location.href = '{{ route("orders.success", $order->id) }}';
        },

        onPending() {
            window.location.href = '{{ route("orders.pending", $order->id) }}';
        },

        onClose() {
            window.location.href = '{{ route("orders.pending", $order->id) }}';
        },

        onError() {
            alert('Pembayaran gagal, silakan coba lagi');
        }

    });

});
</script>
@endif
@endpush
