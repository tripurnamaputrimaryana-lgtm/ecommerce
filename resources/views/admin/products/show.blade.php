@extends('layouts.admin')

@section('title', 'Detail Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0 fw-bold text-pink">
                <i class="bi bi-eye me-1"></i> Detail Produk
            </h2>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.products.edit', $product) }}"
                   class="btn btn-pink">
                    <i class="bi bi-pencil-square me-1"></i> Edit
                </a>
                <a href="{{ route('admin.products.index') }}"
                   class="btn btn-outline-pink">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="row g-4">

            {{-- ================= IMAGES ================= --}}
            <div class="col-lg-5">
                <div class="card pink-card h-100">
                    <div class="card-body p-3">

                        {{-- Primary Image --}}
                        @if($product->primaryImage)
                            <img src="{{ asset('storage/'.$product->primaryImage->image_path) }}"
                                 class="img-fluid rounded-4 mb-3 w-100 main-img">
                        @else
                            <div class="empty-img">
                                <i class="bi bi-image"></i>
                            </div>
                        @endif

                        {{-- Gallery --}}
                        <div class="row g-2">
                            @foreach($product->images as $image)
                                <div class="col-4">
                                    <img src="{{ asset('storage/'.$image->image_path) }}"
                                         class="img-fluid rounded-3 border gallery-img">
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>

            {{-- ================= PRODUCT INFO ================= --}}
            <div class="col-lg-7">
                <div class="card pink-card h-100">
                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-1">
                            {{ $product->name }}
                        </h4>

                        <p class="text-muted mb-3">
                            <i class="bi bi-tags me-1 text-pink"></i>
                            {{ $product->category->name ?? '-' }}
                        </p>

                        {{-- Price --}}
                        <div class="price-box mb-3">
                            @if($product->discount_price && $product->discount_price > 0)
                                <span class="price-main">
                                    Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                                </span>
                                <span class="price-old">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            @else
                                <span class="price-main">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            @endif
                        </div>

                        {{-- Status --}}
                        <div class="mb-4 d-flex gap-2 flex-wrap">
                            <span class="badge badge-soft {{ $product->is_active ? 'bg-soft-success' : 'bg-soft-secondary' }}">
                                {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>

                            @if($product->is_featured)
                                <span class="badge bg-soft-warning text-dark">
                                    <i class="bi bi-star-fill me-1"></i> Unggulan
                                </span>
                            @endif
                        </div>

                        <hr>

                        {{-- Description --}}
                        <div class="mb-4">
                            <h6 class="fw-bold text-pink mb-2">Deskripsi</h6>
                            {!! $product->description ?: '<span class="text-muted">Tidak ada deskripsi</span>' !!}
                        </div>

                        {{-- Meta --}}
                        <div class="row text-center">
                            <div class="col-md-4 mb-3">
                                <div class="meta-box">
                                    <span>Stok</span>
                                    <strong>{{ $product->stock }}</strong>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="meta-box">
                                    <span>Berat</span>
                                    <strong>{{ $product->weight }} g</strong>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="meta-box">
                                    <span>Dibuat</span>
                                    <strong>{{ $product->created_at->format('d M Y') }}</strong>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ===== PINK ELEGANT STYLE ===== --}}
<style>
/* Color */
.text-pink { color:#ff4f9a !important; }

/* Card */
.pink-card{
    border:none;
    border-radius:20px;
    box-shadow:0 12px 30px rgba(255,79,154,.15);
}

/* Buttons */
.btn-pink{
    background:linear-gradient(135deg,#ff4f9a,#ff8fc7);
    color:#fff;
    border:none;
    border-radius:30px;
    padding:8px 20px;
    font-weight:600;
}
.btn-pink:hover{ opacity:.95; }

.btn-outline-pink{
    border:2px solid #ffb6d9;
    color:#ff4f9a;
    border-radius:30px;
    font-weight:600;
}
.btn-outline-pink:hover{
    background:#ffe3f1;
    color:#ff4f9a;
}

/* Images */
.main-img{
    object-fit:cover;
    max-height:320px;
}
.gallery-img{
    height:90px;
    object-fit:cover;
}

/* Empty image */
.empty-img{
    height:320px;
    border-radius:20px;
    background:#fff1f7;
    display:flex;
    align-items:center;
    justify-content:center;
}
.empty-img i{
    font-size:3rem;
    color:#ffb6d9;
}

/* Price */
.price-box{
    display:flex;
    align-items:center;
    gap:12px;
}
.price-main{
    font-size:1.4rem;
    font-weight:700;
    color:#ff4f9a;
}
.price-old{
    text-decoration:line-through;
    color:#aaa;
}

/* Badge Soft */
.badge-soft{
    padding:6px 14px;
    border-radius:20px;
    font-weight:600;
}
.bg-soft-success{ background:#dff7ee; color:#198754; }
.bg-soft-secondary{ background:#f1f1f1; color:#6c757d; }
.bg-soft-warning{ background:#fff3cd; }

/* Meta */
.meta-box{
    background:#fff5fa;
    border-radius:16px;
    padding:14px;
}
.meta-box span{
    display:block;
    font-size:.8rem;
    color:#888;
}
.meta-box strong{
    font-size:1.1rem;
    color:#ff4f9a;
}
</style>
@endsection
