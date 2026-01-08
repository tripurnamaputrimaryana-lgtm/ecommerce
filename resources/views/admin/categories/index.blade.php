@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@push('styles')
<style>
    /* ===== ICON & MODAL FIX ===== */
    .bi {
        font-family: bootstrap-icons !important;
        font-style: normal;
    }

    .modal-content {
        background-color: #fff !important;
    }

    .modal-backdrop.show {
        opacity: .5;
    }

    /* ===== SMOOTH MODAL ANIMATION ===== */
    .modal.fade .modal-dialog {
        transform: scale(.95);
        transition: transform .2s ease-out;
    }

    .modal.show .modal-dialog {
        transform: scale(1);
    }

    /* ===== PINK THEME ===== */
    .bg-pink {
        background: linear-gradient(135deg, #ff6fae, #ff9fcf) !important;
    }

    .text-pink {
        color: #ff6fae !important;
    }

    .btn-pink {
        background: linear-gradient(90deg, #ff6fae, #ff9fcf);
        color: #fff;
        border: none;
        border-radius: 20px;
        padding: 6px 18px;
        transition: 0.3s;
    }

    .btn-pink:hover {
        opacity: 0.9;
    }

    .btn-outline-pink {
        border: 1px solid #ff6fae;
        color: #ff6fae;
        border-radius: 20px;
        padding: 6px 18px;
        transition: 0.3s;
        background: transparent;
    }

    .btn-outline-pink:hover {
        background: linear-gradient(90deg, #ff6fae, #ff9fcf);
        color: #fff;
    }

    .badge-info-subtle.text-info,
    .badge-success-subtle.text-success,
    .badge-secondary-subtle.text-secondary,
    .bg-primary-subtle.text-primary {
        background-color: #ffe3f1 !important;
        color: #ff6fae !important;
    }

    .card-footer.bg-white {
        background-color: #fff;
    }

    .form-check-input:checked {
        background-color: #ff6fae;
        border-color: #ff6fae;
    }

    .btn-close {
        filter: invert(1); /* tombol close putih di modal pink */
    }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">

        {{-- FLASH MESSAGE --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-1 text-pink"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle me-1 text-pink"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="card shadow-sm border-0 mb-4">

            {{-- CARD HEADER --}}
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="bi bi-tags me-2"></i> Manajemen Kategori
                    </h5>
                    <small class="opacity-75 text-white">Kelola kategori produk</small>
                </div>

                <button class="btn btn-light btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-plus-circle me-1 text-pink"></i> Tambah
                </button>
            </div>

            {{-- TABLE --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Kategori</th>
                                <th class="text-center">Produk</th>
                                <th class="text-center">Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        @if($category->image)
                                        <img src="{{ Storage::url($category->image) }}" class="rounded-circle me-3 border border-pink"
                                             width="44" height="44" style="object-fit:cover">
                                        @else
                                        @php
                                            $icons = [
                                                'floral' => 'bi-flower1',
                                                'woody' => 'bi-tree-fill',
                                                'oriental' => 'bi-fire',
                                                'fresh-citrus' => 'bi-brightness-high',
                                                'aquatic' => 'bi-droplet-half',
                                                'gourmand' => 'bi-cup-hot-fill',
                                            ];
                                            $icon = $icons[$category->slug] ?? 'bi-tags';
                                        @endphp
                                        <div class="bg-primary-subtle text-pink rounded-circle
                                                    d-flex align-items-center justify-content-center me-3"
                                             style="width:44px;height:44px">
                                            <i class="bi {{ $icon }} fs-5"></i>
                                        </div>
                                        @endif

                                        <div>
                                            <div class="fw-bold text-pink">{{ $category->name }}</div>
                                            <small class="text-muted">{{ $category->slug }}</small>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <span class="badge bg-info-subtle text-pink fw-semibold px-3 py-2">
                                        <i class="bi bi-box-seam me-1"></i>
                                        {{ $category->products_count }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    @if($category->is_active)
                                    <span class="badge bg-success-subtle text-pink px-3 py-2">
                                        <i class="bi bi-check-circle me-1"></i> Aktif
                                    </span>
                                    @else
                                    <span class="badge bg-secondary-subtle text-pink px-3 py-2">
                                        <i class="bi bi-x-circle me-1"></i> Nonaktif
                                    </span>
                                    @endif
                                </td>

                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-pink" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $category->id }}" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                              onsubmit="return confirm('Yakin hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-pink" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder-x fs-3 d-block mb-2"></i>
                                    Belum ada kategori
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-white">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>

{{-- ================= EDIT MODAL ================= --}}
@foreach($categories as $category)
<div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content border-0 shadow-lg rounded-4"
              action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="modal-header bg-pink">
                <h5 class="modal-title fw-bold text-white">
                    <i class="bi bi-pencil-square me-1"></i> Edit Kategori
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold text-pink">Nama Kategori</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold text-pink">Gambar</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }}>
                    <label class="form-check-label text-pink">Aktif</label>
                </div>
            </div>

            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-pink" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-pink">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach

{{-- ================= CREATE MODAL ================= --}}
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content border-0 shadow-lg rounded-4"
              action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="modal-header bg-pink">
                <h5 class="modal-title fw-bold text-white">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Kategori
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold text-pink">Nama Kategori</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Elektronik" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold text-pink">Gambar</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                    <label class="form-check-label text-pink">Langsung Aktif</label>
                </div>
            </div>

            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-pink" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-pink">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
