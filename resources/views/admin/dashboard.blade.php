@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

{{-- ================= SUMMARY ================= --}}
<div class="row g-4 mb-4">

    {{-- Revenue --}}
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card pink-gradient shadow-lg border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-white-50 fw-semibold">TOTAL PENDAPATAN</small>
                    <h4 class="fw-bold text-white mt-1">
                        Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
                    </h4>
                </div>
                <i class="bi bi-wallet2 stat-icon"></i>
            </div>
        </div>
    </div>

    {{-- Pending --}}
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card pink-soft shadow border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted fw-semibold">PERLU DIPROSES</small>
                    <h4 class="fw-bold text-pink">{{ $stats['pending_orders'] }}</h4>
                </div>
                <i class="bi bi-tags stat-icon text-pink"></i>
            </div>
        </div>
    </div>

    {{-- Low Stock --}}
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card pink-soft shadow border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted fw-semibold">STOK MENIPIS</small>
                    <h4 class="fw-bold text-pink">{{ $stats['low_stock'] }}</h4>
                </div>
                <i class="bi bi-exclamation-triangle stat-icon text-pink"></i>
            </div>
        </div>
    </div>

    {{-- Total Products --}}
    <div class="col-md-6 col-xl-3">
        <div class="card stat-card pink-soft shadow border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted fw-semibold">TOTAL PRODUK</small>
                    <h4 class="fw-bold text-pink">{{ $stats['total_products'] }}</h4>
                </div>
                <i class="bi bi-box-seam stat-icon text-pink"></i>
            </div>
        </div>
    </div>

</div>

{{-- ================= CHART & ORDERS ================= --}}
<div class="row g-4">

    {{-- Chart --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header bg-white fw-bold fs-5">
                Grafik Penjualan
            </div>
            <div class="card-body">
                <canvas id="revenueChart" height="120"></canvas>
            </div>
        </div>
    </div>

    {{-- Orders --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-lg rounded-4 h-100">
            <div class="card-header bg-white fw-bold fs-5">
                Pesanan Terbaru
            </div>
            <div class="list-group list-group-flush">
                @foreach($recentOrders as $order)
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <div>
                            <div class="fw-bold text-pink">#{{ $order->order_number }}</div>
                            <small class="text-muted">{{ $order->user->name }}</small>
                        </div>
                        <div class="text-end">
                            <div class="fw-semibold">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </div>
                            <span class="badge badge-pink">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer bg-white text-center">
                <a href="{{ route('admin.orders.index') }}" class="fw-bold text-pink">
                    Lihat Semua →
                </a>
            </div>
        </div>
    </div>

</div>

{{-- ================= TOP PRODUCTS ================= --}}
<div class="card border-0 shadow-lg rounded-4 mt-4">
    <div class="card-header bg-white fw-bold fs-5">
        Produk Terlaris
    </div>
    <div class="card-body">
        <div class="row g-4">
            @foreach($topProducts as $product)
                <div class="col-6 col-md-2">
                    <div class="card border-0 shadow-sm product-card text-center">
                        <img src="{{ $product->image_url }}"
                             class="rounded mb-2">
                        <h6 class="fw-semibold text-truncate">{{ $product->name }}</h6>
                        <small class="text-muted">{{ $product->sold }} terjual</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ================= STYLE ================= --}}
<style>
.text-pink{color:#ff6fae}
.pink-gradient{
    background:linear-gradient(135deg,#ff6fae,#ff9fcf);
}
.pink-soft{
    background:#fff0f7;
}
.stat-card{
    border-radius:20px;
    min-height:120px;
}
.stat-icon{
    font-size:3rem;
    color:rgba(255,255,255,.7);
}
.badge-pink{
    background:#ffe3f1;
    color:#ff6fae;
    padding:6px 14px;
    border-radius:20px;
}
.product-card img{
    width:100%;
    height:90px;
    object-fit:cover;
}
</style>

{{-- ================= CHART ================= --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('revenueChart'), {
    type:'line',
    data:{
        labels:{!! json_encode($revenueChart->pluck('date')) !!},
        datasets:[{
            data:{!! json_encode($revenueChart->pluck('total')) !!},
            borderColor:'#ff6fae',
            backgroundColor:'rgba(255,111,174,.2)',
            borderWidth:3,
            tension:.4,
            fill:true,
            pointRadius:4
        }]
    },
    options:{
        plugins:{legend:{display:false}},
        scales:{
            y:{
                ticks:{
                    callback:v=>'Rp '+new Intl.NumberFormat('id-ID').format(v)
                }
            }
        }
    }
});
</script>

@endsection
