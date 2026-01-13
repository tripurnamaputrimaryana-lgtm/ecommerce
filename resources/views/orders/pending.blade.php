@extends('layouts.app')

@section('title', 'Pembayaran Pending')

@section('content')

<style>
:root{
    --pink-main:#ff4f9a;
    --pink-soft:#fff1f7;
    --pink-dark:#b1124d;
}

.text-pink{
    color:var(--pink-main);
}

.bg-pink-soft{
    background:var(--pink-soft);
}

.card-pink{
    border-radius:22px;
    border:1px solid #f6c1da;
}

.btn-pink{
    background:linear-gradient(135deg,#ff4f9a,#ff7fbf);
    color:#fff;
    border:none;
    border-radius:18px;
    padding:12px 30px;
    font-weight:600;
    transition:.3s;
}

.btn-pink:hover{
    background:linear-gradient(135deg,#ff2f86,#ff6ab2);
    box-shadow:0 10px 25px rgba(255,79,154,.45);
}

.icon-circle{
    width:90px;
    height:90px;
    border-radius:50%;
    background:var(--pink-soft);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:42px;
    color:var(--pink-main);
    margin:0 auto;
}
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card card-pink shadow-sm text-center p-4 bg-white">

                <div class="icon-circle mb-4">
                    <i class="bi bi-hourglass-split"></i>
                </div>

                <h2 class="fw-bold text-pink mb-3">
                    Pembayaran Pending
                </h2>

                <p class="text-muted mb-4">
                    Pembayaran pesanan kamu masih <b>menunggu penyelesaian</b>.
                    Silakan selesaikan pembayaran sesuai instruksi dari metode pembayaran yang kamu pilih.
                </p>

                <div class="bg-pink-soft rounded-3 p-3 mb-4">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Jika pembayaran berhasil, status pesanan akan otomatis berubah menjadi
                        <b class="text-pink">Diproses</b>.
                    </small>
                </div>

                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-pink">
                        <i class="bi bi-receipt me-2"></i>
                        Lihat Detail Pesanan
                    </a>

                    <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        Kembali ke Beranda
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
