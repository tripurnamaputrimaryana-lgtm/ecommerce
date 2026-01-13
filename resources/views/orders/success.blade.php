@extends('layouts.app')

@section('title', 'Pembayaran Berhasil')

@section('content')

<style>
:root{
    --pink-main:#ff4f9a;
    --pink-soft:#fff1f7;
    --pink-dark:#b1124d;
}

.text-pink{ color:var(--pink-main); }

.bg-pink-soft{ background:var(--pink-soft); }

.card-pink{
    border-radius:22px;
    border:1px solid #f6c1da;
}

.btn-pink{
    background:linear-gradient(135deg,#ff4f9a,#ff7fbf);
    color:#fff;
    border:none;
    border-radius:18px;
    padding:12px 34px;
    font-weight:600;
    transition:.35s;
}

.btn-pink:hover{
    background:linear-gradient(135deg,#ff2f86,#ff6ab2);
    transform:translateY(-2px);
    box-shadow:0 12px 28px rgba(255,79,154,.45);
}

.icon-circle{
    width:90px;
    height:90px;
    border-radius:50%;
    background:var(--pink-soft);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:44px;
    color:var(--pink-main);
    margin:0 auto;
}
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card card-pink shadow-sm text-center p-4 bg-white">

                <div class="icon-circle mb-4">
                    <i class="bi bi-check-circle-fill"></i>
                </div>

                <h2 class="fw-bold text-pink mb-3">
                    Pembayaran Berhasil 🎉
                </h2>

                <p class="text-muted mb-4">
                    Terima kasih! Pembayaran pesanan kamu telah
                    <b class="text-pink">berhasil</b> dan pesanan sedang
                    <b>diproses</b> oleh tim kami.
                </p>

                <div class="bg-pink-soft rounded-3 p-3 mb-4">
                    <small class="text-muted">
                        <i class="bi bi-box-seam me-1"></i>
                        Kamu akan menerima notifikasi ketika pesanan mulai dikirim.
                    </small>
                </div>

                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-pink">
                        <i class="bi bi-receipt me-2"></i>
                        Lihat Detail Pesanan
                    </a>

                    <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        Lanjut Belanja
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
