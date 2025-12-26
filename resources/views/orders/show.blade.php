@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container py-4">

    <h3 class="mb-4 fw-bold">📄 Detail Pesanan</h3>

    <div class="card shadow-sm border-0">
        {{-- Header Order --}}
        <div class="card-header bg-white d-flex justify-content-between align-items-start">
            <div>
                <h5 class="fw-bold mb-1">Order #{{ $order->order_number }}</h5>
                <small class="text-muted">
                    {{ $order->created_at->format('d M Y, H:i') }}
                </small>
            </div>

            {{-- Status Badge --}}
            <span class="badge
                @switch($order->status)
                    @case('pending') bg-warning text-dark @break
                    @case('processing') bg-primary @break
                    @case('shipped') bg-info text-dark @break
                    @case('delivered') bg-success @break
                    @case('cancelled') bg-danger @break
                    @default bg-secondary
                @endswitch">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        {{-- Detail Items --}}
        <div class="card-body">
            <h6 class="fw-semibold mb-3">Produk yang Dipesan</h6>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
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
                            <td>{{ $item->product_name }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="text-end">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        @if($order->shipping_cost > 0)
                        <tr>
                            <td colspan="3" class="text-end">Ongkos Kirim:</td>
                            <td class="text-end">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td colspan="3" class="text-end fw-bold">TOTAL BAYAR:</td>
                            <td class="text-end fw-bold text-primary">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{-- Alamat Pengiriman --}}
        <div class="card-footer bg-light">
            <h6 class="fw-semibold mb-2">Alamat Pengiriman</h6>
            <address class="mb-0">
                <strong>{{ $order->shipping_name }}</strong><br>
                {{ $order->shipping_phone }}<br>
                {{ $order->shipping_address }}
            </address>
        </div>

        {{-- Tombol Bayar --}}
        @if($order->status === 'pending' && $snapToken)
        <div class="card-footer bg-light text-center">
            <p class="text-muted mb-3">Selesaikan pembayaran Anda sebelum batas waktu berakhir.</p>
            <button id="pay-button" class="btn btn-primary btn-lg fw-bold px-5">
                💳 Bayar Sekarang
            </button>
        </div>
        @endif
    </div>
</div>

{{-- Snap.js Integration --}}
@if($snapToken)
@push('scripts')
<script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const payButton = document.getElementById('pay-button');
    if (payButton) {
        payButton.addEventListener('click', function() {
            payButton.disabled = true;
            payButton.textContent = 'Memproses...';
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function() {
                    window.location.href = '{{ route("orders.success", $order) }}';
                },
                onPending: function() {
                    window.location.href = '{{ route("orders.pending", $order) }}';
                },
                onError: function() {
                    alert('Pembayaran gagal! Silakan coba lagi.');
                    payButton.disabled = false;
                    payButton.textContent = '💳 Bayar Sekarang';
                },
                onClose: function() {
                    payButton.disabled = false;
                    payButton.textContent = '💳 Bayar Sekarang';
                }
            });
        });
    }
});
</script>
@endpush
@endif
@endsection