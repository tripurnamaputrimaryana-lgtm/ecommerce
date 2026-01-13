@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')

<style>
    :root {
        --pink-main: #ff4f9a;
        --pink-soft: #fff1f7;
        --pink-dark: #c2185b;
    }

    /* Nav Pills */
    .nav-pills .nav-link {
        color: var(--pink-dark);
        border-radius: 20px;
        margin-right: 6px;
    }

    .nav-pills .nav-link.active {
        background: linear-gradient(135deg, var(--pink-main), #ff85b8);
        color: #fff;
    }

    /* Title */
    .text-gray-800 {
        color: var(--pink-dark) !important;
    }

    /* Table Accent */
    .table thead {
        background-color: var(--pink-soft);
    }

    .table-hover tbody tr:hover {
        background-color: #fff5fa;
    }

    /* Order Number */
    .text-primary {
        color: var(--pink-main) !important;
    }

    /* Buttons */
    .btn-outline-primary {
        color: var(--pink-main);
        border-color: var(--pink-main);
    }

    .btn-outline-primary:hover {
        background-color: var(--pink-main);
        color: #fff;
    }

    /* Badge Status */
    .badge.bg-warning {
        background-color: #ffd1e3 !important;
        color: #a8004f !important;
    }

    .badge.bg-info {
        background-color: #ffb6d5 !important;
        color: #880e4f !important;
    }

    .badge.bg-primary {
        background-color: var(--pink-main) !important;
    }

    .badge.bg-success {
        background-color: #e91e63 !important;
    }

    .badge.bg-danger {
        background-color: #ad1457 !important;
    }

    /* Pagination */
    .pagination .page-link {
        color: var(--pink-main);
    }

    .pagination .page-item.active .page-link {
        background-color: var(--pink-main);
        border-color: var(--pink-main);
        color: #fff;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800">Daftar Pesanan</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link {{ !request('status') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">Semua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'pending']) }}">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('status') == 'processing' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'processing']) }}">Diproses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('status') == 'shipped' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'shipped']) }}">Dikirim</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('status') == 'delivered' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'delivered']) }}">Sampai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('status') == 'cancelled' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}">Batal</a>
            </li>
        </ul>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">No. Order</th>
                        <th>Customer</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="ps-4 fw-bold text-primary">#{{ $order->order_number }}</td>
                            <td>
                                <div class="fw-bold">{{ $order->user->name }}</div>
                                <small class="text-muted">{{ $order->user->email }}</small>
                            </td>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td class="fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td>
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($order->status == 'processing')
                                    <span class="badge bg-info">Diproses</span>
                                @elseif($order->status == 'shipped')
                                    <span class="badge bg-primary">Dikirim</span>
                                @elseif($order->status == 'delivered')
                                    <span class="badge bg-success">Sampai</span>
                                @elseif($order->status == 'cancelled')
                                    <span class="badge bg-danger">Batal</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                Tidak ada pesanan ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer bg-white">
        {{ $orders->links() }}
    </div>
</div>
@endsection
