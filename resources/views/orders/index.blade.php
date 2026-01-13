@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')

<style>
/* ================= THEME PINK ================= */
:root{
    --pink-main:#ff4f9a;
    --pink-soft:#fff1f7;
    --pink-dark:#b1124d;
    --pink-border:#f6c1da;
}

body{
    background:linear-gradient(180deg,#fffafd,#ffffff);
}

.text-pink{ color:var(--pink-main); }

/* ================= CARD ================= */
.order-card{
    border-radius:22px;
    border:1px solid var(--pink-border);
    background:#fff;
    box-shadow:0 14px 32px rgba(255,79,154,.15);
    overflow:hidden;
}

/* ================= TABLE ================= */
.table thead th{
    background:linear-gradient(135deg,#ff4f9a,#ff7fbf);
    color:#fff;
    text-transform:uppercase;
    font-size:.75rem;
    letter-spacing:.08em;
    padding:1.1rem 1rem;
    border:none;
}

.table tbody tr{
    transition:.25s ease;
}

.table tbody tr:hover{
    background:var(--pink-soft);
}

.table td{
    vertical-align:middle;
}

/* ================= BADGE STATUS ================= */
.badge-soft{
    padding:.55rem .9rem;
    border-radius:999px;
    font-weight:600;
    font-size:.75rem;
    display:inline-flex;
    align-items:center;
    gap:6px;
}

.badge-pending{
    background:#fff0f6;
    color:var(--pink-main);
    border:1px solid #ffc1dc;
}

.badge-processing{
    background:#fdf4ff;
    color:#9333ea;
}

.badge-shipped{
    background:#eef2ff;
    color:#4338ca;
}

.badge-success{
    background:#f0fdf4;
    color:#166534;
}

.badge-cancel{
    background:#fef2f2;
    color:#991b1b;
}

/* ================= BUTTON ================= */
.btn-detail{
    border-radius:14px;
    padding:.45rem 1.1rem;
    font-weight:600;
    font-size:.85rem;
    border:1px solid var(--pink-border);
    color:var(--pink-main);
    background:#fff;
    transition:.3s ease;
}

.btn-detail:hover{
    background:var(--pink-main);
    color:#fff;
    transform:translateY(-2px);
    box-shadow:0 10px 22px rgba(255,79,154,.35);
}
</style>

<div class="container py-5">

    {{-- HEADER --}}
    <div class="mb-4">
        <h1 class="h3 fw-bold mb-1 text-pink">
            Riwayat Pesanan
        </h1>
        <p class="text-muted small mb-0">
            Pantau status dan riwayat belanja kamu 💖
        </p>
    </div>

    {{-- TABLE CARD --}}
    <div class="order-card">

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">No Order</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($orders as $order)

                    <tr>
                        <td class="ps-4 fw-bold text-dark">
                            #{{ $order->order_number }}
                        </td>

                        <td>
                            <div class="fw-semibold">
                                {{ $order->created_at->translatedFormat('d M Y') }}
                            </div>
                            <div class="small text-muted">
                                {{ $order->created_at->format('H:i') }} WIB
                            </div>
                        </td>

                        <td>
                            @if($order->status === 'pending')
                                <span class="badge-soft badge-pending">
                                    <i class="bi bi-hourglass-split"></i> Menunggu
                                </span>
                            @elseif($order->status === 'processing')
                                <span class="badge-soft badge-processing">
                                    <i class="bi bi-arrow-repeat"></i> Diproses
                                </span>
                            @elseif($order->status === 'shipped')
                                <span class="badge-soft badge-shipped">
                                    <i class="bi bi-truck"></i> Dikirim
                                </span>
                            @elseif($order->status === 'delivered')
                                <span class="badge-soft badge-success">
                                    <i class="bi bi-check2-all"></i> Selesai
                                </span>
                            @else
                                <span class="badge-soft badge-cancel">
                                    <i class="bi bi-x-circle"></i> Dibatalkan
                                </span>
                            @endif
                        </td>

                        <td class="fw-bold text-pink">
                            Rp {{ number_format($order->total_amount,0,',','.') }}
                        </td>

                        <td class="text-end pe-4">
                            <a href="{{ route('orders.show',$order) }}" class="btn btn-detail">
                                <i class="bi bi-eye me-1"></i> Detail
                            </a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="bi bi-bag-x fs-1 text-muted opacity-50"></i>
                            <p class="text-muted mt-2 mb-0">
                                Belum ada pesanan
                            </p>
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

        {{-- PAGINATION --}}
        @if($orders->hasPages())
        <div class="py-4 d-flex justify-content-center">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
        @endif

    </div>

</div>
@endsection
    