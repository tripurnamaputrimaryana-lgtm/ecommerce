@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0 fw-bold text-pink">
                <i class="bi bi-pencil-square me-1"></i> Edit Produk
            </h2>
            <a href="{{ route('admin.products.index') }}"
               class="btn btn-outline-pink">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- ================= BASIC INFO ================= --}}
            <div class="card pink-card mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3 section-title">
                        <i class="bi bi-info-circle me-1"></i> Informasi Produk
                    </h6>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" name="name"
                               class="form-control pink-input @error('name') is-invalid @enderror"
                               value="{{ old('name', $product->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="category_id"
                                class="form-select pink-input @error('category_id') is-invalid @enderror" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Deskripsi Produk</label>
                        <textarea name="description" rows="4"
                            class="form-control pink-input @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            {{-- ================= PRICE & STOCK ================= --}}
            <div class="card pink-card mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3 section-title">
                        <i class="bi bi-cash-stack me-1"></i> Harga & Stok
                    </h6>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Harga (Rp)</label>
                            <input type="number" name="price"
                                   class="form-control pink-input @error('price') is-invalid @enderror"
                                   value="{{ old('price', $product->price) }}" required>
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Harga Diskon</label>
                            <input type="number" name="discount_price"
                                   class="form-control pink-input @error('discount_price') is-invalid @enderror"
                                   value="{{ old('discount_price', $product->discount_price) }}">
                            @error('discount_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Stok</label>
                            <input type="number" name="stock"
                                   class="form-control pink-input @error('stock') is-invalid @enderror"
                                   value="{{ old('stock', $product->stock) }}" required>
                            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Berat (gram)</label>
                        <input type="number" name="weight"
                               class="form-control pink-input @error('weight') is-invalid @enderror"
                               value="{{ old('weight', $product->weight) }}" required>
                        @error('weight') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            {{-- ================= IMAGES ================= --}}
            <div class="card pink-card mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3 section-title">
                        <i class="bi bi-images me-1"></i> Gambar Produk
                    </h6>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Tambah Gambar Baru</label>
                        <input type="file" name="images[]" class="form-control pink-input" multiple>
                        <small class="text-muted">Upload untuk menambah gambar baru</small>
                    </div>

                    <div class="row g-3">
                        @foreach($product->images as $image)
                        <div class="col-md-3">
                            <div class="card image-card">
                                <img src="{{ asset('storage/'.$image->image_path) }}"
                                     class="card-img-top img-fit">

                                <div class="card-body p-2 text-center">
                                    <div class="form-check mb-1">
                                        <input class="form-check-input pink-check" type="radio"
                                               name="primary_image"
                                               value="{{ $image->id }}"
                                               {{ $image->is_primary ? 'checked' : '' }}>
                                        <label class="form-check-label small">
                                            Gambar Utama
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input pink-check" type="checkbox"
                                               name="delete_images[]" value="{{ $image->id }}">
                                        <label class="form-check-label small text-danger">
                                            Hapus
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>

            {{-- ================= STATUS ================= --}}
            <div class="card pink-card mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3 section-title">
                        <i class="bi bi-toggle-on me-1"></i> Status Produk
                    </h6>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input pink-switch" type="checkbox"
                                       name="is_active" value="1"
                                       {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold">Aktif</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input pink-switch" type="checkbox"
                                       name="is_featured" value="1"
                                       {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold">Produk Unggulan</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SUBMIT --}}
            <div class="d-grid mb-5">
                <button type="submit" class="btn btn-pink btn-lg">
                    <i class="bi bi-save me-1"></i> Update Produk
                </button>
            </div>

        </form>
    </div>
</div>

{{-- ===== PINK ELEGANT STYLE ===== --}}
<style>
.text-pink{ color:#ff4f9a !important; }

.section-title{ color:#ff4f9a; }

/* Card */
.pink-card{
    border:none;
    border-radius:22px;
    box-shadow:0 14px 32px rgba(255,79,154,.15);
}

/* Inputs */
.pink-input{
    border-radius:14px;
}
.pink-input:focus{
    border-color:#ff8fc7;
    box-shadow:0 0 0 .2rem rgba(255,79,154,.15);
}

/* Buttons */
.btn-pink{
    background:linear-gradient(135deg,#ff4f9a,#ff8fc7);
    color:#fff;
    border:none;
    border-radius:30px;
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

/* Image Card */
.image-card{
    border:none;
    border-radius:18px;
    box-shadow:0 8px 22px rgba(0,0,0,.08);
}
.img-fit{
    height:160px;
    object-fit:cover;
}

/* Switch & Check */
.pink-switch:checked{
    background-color:#ff4f9a;
    border-color:#ff4f9a;
}
.pink-check:checked{
    background-color:#ff4f9a;
    border-color:#ff4f9a;
}
</style>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/ctgoj8efdfr1i2jqusoi0hyy1luhjn7lk7r8rnmmhe2f6r35/tinymce/8/tinymce.min.js"
    referrerpolicy="origin" crossorigin="anonymous"></script>

<script>
tinymce.init({
    selector: 'textarea',
    height: 260,
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks | bold italic underline | align | numlist bullist | link image | emoticons | removeformat',
});
</script>
@endpush
