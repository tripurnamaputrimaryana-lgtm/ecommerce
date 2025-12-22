@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">

        <div class="card shadow-sm border-0 mb-4">

            {{-- CARD HEADER --}}
            <div class="card-header bg-primary bg-gradient text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-box-seam me-2"></i> Daftar Produk
                    </h5>
                    <small class="opacity-75">Kelola data produk</small>
                </div>

                <a href="{{ route('admin.products.create') }}" class="btn btn-light btn-sm fw-semibold">
                    <i class="bi bi-plus-circle me-1"></i> Tambah
                </a>
            </div>

            {{-- FILTER --}}
            <div class="card-body border-bottom">
                <form method="GET" class="row g-2">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Cari produk..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="category" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category')==$category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-outline-primary w-100">
                            <i class="bi bi-filter"></i> Filter
                        </button>
                    </div>
                </form>
            </div>

            {{-- TABLE --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Produk</th>
                                <th>Kategori</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Stok</th>
                                <th class="text-center">Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $product->primaryImage?->image_url ?? asset('img/no-image.png') }}"
                                            class="rounded border me-3" width="44" height="44">
                                        <div>
                                            <div class="fw-bold">{{ $product->name }}</div>
                                            <small class="text-muted">SKU: {{ $product->sku ?? '-' }}</small>
                                        </div>
                                    </div>
                                </td>

                                <td>{{ $product->category->name }}</td>

                                <td class="text-center">
                                    Rp {{ number_format($product->price) }}
                                </td>

                                <td class="text-center">
                                    <span class="badge bg-info-subtle text-info px-3 py-2">
                                        {{ $product->stock }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    @if($product->is_active)
                                    <span class="badge bg-success-subtle text-success px-3 py-2">
                                        <i class="bi bi-check-circle me-1"></i> Aktif
                                    </span>
                                    @else
                                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2">
                                        <i class="bi bi-x-circle me-1"></i> Nonaktif
                                    </span>
                                    @endif
                                </td>

                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.products.show', $product) }}"
                                            class="btn btn-sm btn-outline-info" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                            class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-box fs-3 d-block mb-2"></i>
                                    Data produk kosong
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- PAGINATION --}}
            <div class="card-footer bg-white">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>
@endsection
