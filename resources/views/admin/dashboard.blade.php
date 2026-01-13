@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')

<div class="container-fluid py-2">
    {{-- ================= HEADER DASHBOARD ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h3 class="fw-bold text-dark mb-1">Ringkasan Bisnis</h3>
            <p class="text-muted small">Pantau performa Luméa Maison de Parfum Anda.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-luxury-rose shadow-sm rounded-pill px-4 btn-sm text-white">
                <i class="bi bi-plus-lg me-2"></i> Produk Baru
            </button>
        </div>
    </div>

    {{-- ================= STATS CARDS ================= --}}
    <div class="row g-4 mb-5">
        @php
            $cards = [
                ['label' => 'Total Pendapatan', 'value' => 'Rp ' . number_format($stats['total_revenue'], 0, ',', '.'), 'icon' => 'bi-currency-dollar', 'color' => 'luxury-rose'],
                ['label' => 'Pesanan Baru', 'value' => $stats['pending_orders'], 'icon' => 'bi-cart-check', 'color' => 'soft-rose'],
                ['label' => 'Stok Menipis', 'value' => $stats['low_stock'], 'icon' => 'bi-moisture', 'color' => 'soft-rose'],
                ['label' => 'Koleksi Produk', 'value' => $stats['total_products'], 'icon' => 'bi-flower1', 'color' => 'soft-rose'],
            ];
        @endphp

        @foreach($cards as $card)
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-soft h-100 rounded-4 {{ $card['color'] == 'luxury-rose' ? 'bg-luxury-rose text-white' : 'bg-white' }}">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-shape {{ $card['color'] == 'luxury-rose' ? 'bg-white-20' : 'bg-soft-rose' }}">
                            <i class="bi {{ $card['icon'] }} {{ $card['color'] == 'luxury-rose' ? 'text-white' : 'text-deep-rose' }}"></i>
                        </div>
                    </div>
                    <small class="{{ $card['color'] == 'luxury-rose' ? 'text-white-50' : 'text-muted' }} fw-bold letter-spacing-1 text-uppercase">{{ $card['label'] }}</small>
                    <h3 class="fw-bold mt-1 mb-0">{{ $card['value'] }}</h3>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row g-4">
        {{-- ================= CHART SECTION ================= --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-soft rounded-4 h-100">
                <div class="card-header bg-transparent border-0 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Tren Penjualan</h5>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm rounded-pill px-3" data-bs-toggle="dropdown">Minggu Ini</button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 pt-0">
                    <div style="height: 350px;">
                        <canvas id="luxuryRevenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= RECENT ACTIVITY ================= --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-soft rounded-4 h-100">
                <div class="card-header bg-transparent border-0 p-4 pb-0">
                    <h5 class="fw-bold mb-0">Transaksi Terakhir</h5>
                </div>
                <div class="card-body p-4">
                    <div class="timeline-luxury">
                        @foreach($recentOrders as $order)
                        <div class="timeline-item d-flex gap-3 mb-4">
                            <div class="avatar-sm rounded-circle bg-soft-rose d-flex align-items-center justify-content-center flex-shrink-0">
                                <i class="bi bi-bag-heart text-deep-rose"></i>
                            </div>
                            <div class="flex-grow-1 border-bottom pb-3">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-bold mb-1">#{{ $order->order_number }}</h6>
                                    <span class="text-deep-rose fw-bold small">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                </div>
                                <p class="text-muted small mb-0">{{ $order->user->name }} • {{ ucfirst($order->status) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-soft-rose w-100 rounded-pill mt-2 fw-bold py-2">
                        Semua Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ================= CUSTOM STYLE ================= --}}
<style>
    :root {
        --deep-rose: #d63384;
        --luxury-pink: #ff85c1;
        --soft-rose: #fdeef4;
        --bg-main: #fcf8fa;
    }

    body { background-color: var(--bg-main); }

    /* Card Styling */
    .shadow-soft { box-shadow: 0 10px 30px rgba(214, 51, 132, 0.05); }
    .bg-luxury-rose { background: linear-gradient(135deg, var(--deep-rose) 0%, var(--luxury-pink) 100%); }
    .bg-soft-rose { background-color: var(--soft-rose); }
    .text-deep-rose { color: var(--deep-rose) !important; }
    
    .icon-shape {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.4rem;
    }
    .bg-white-20 { background: rgba(255, 255, 255, 0.2); }
    .letter-spacing-1 { letter-spacing: 1px; font-size: 0.75rem; }

    /* Button Styling */
    .btn-luxury-rose { background-color: var(--deep-rose); border-color: var(--deep-rose); }
    .btn-luxury-rose:hover { background-color: var(--luxury-pink); border-color: var(--luxury-pink); }
    .btn-soft-rose { background-color: var(--soft-rose); color: var(--deep-rose); border: none; }
    .btn-soft-rose:hover { background-color: var(--deep-rose); color: white; }

    /* Avatar & Timeline */
    .avatar-sm { width: 40px; height: 40px; }
    .timeline-item:last-child .flex-grow-1 { border-bottom: none !important; }

    /* Typography */
    h3, h5, h6 { font-family: 'Playfair Display', serif; }
    p, small, span, button { font-family: 'Montserrat', sans-serif; }
</style>

{{-- ================= CHART JS SCRIPT ================= --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('luxuryRevenueChart').getContext('2d');

    // Gradient Background Area
    let fillGradient = ctx.createLinearGradient(0, 0, 0, 400);
    fillGradient.addColorStop(0, 'rgba(214, 51, 132, 0.25)');
    fillGradient.addColorStop(1, 'rgba(214, 51, 132, 0.0)');

    // Data Labels & Values
    const labels = {!! json_encode($revenueChart->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M'))->toArray()) !!};
    const data = {!! json_encode($revenueChart->pluck('total')->toArray()) !!};

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pendapatan',
                data: data,
                borderColor: '#d63384',
                borderWidth: 4,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#d63384',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                tension: 0.4,
                fill: true,
                backgroundColor: fillGradient
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: '#fff',
                    titleColor: '#000',
                    bodyColor: '#666',
                    borderColor: '#fdeef4',
                    borderWidth: 1,
                    padding: 15,
                    displayColors: false,
                    callbacks: {
                        label: function(c) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(c.raw);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false },
                    ticks: {
                        font: { size: 11 },
                        callback: (v) => v >= 1000 ? (v/1000) + 'k' : v
                    }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
});
</script>

@endsection