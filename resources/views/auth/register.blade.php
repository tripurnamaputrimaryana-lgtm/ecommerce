{{-- ======================================== 
FILE: resources/views/auth/register.blade.php 
FUNGSI: Halaman form register tanpa gambar, posisi tengah
======================================== --}}
@extends('layouts.app')

@section('content')

<style>
    body.register-bg {
        min-height: 100vh;
        background: linear-gradient(135deg, #ffe4ec 0%, #ffd9f7 100%);
        background-attachment: fixed;
    }

    .register-glass {
        background: rgba(255, 255, 255, 0.92);
        box-shadow: 0 10px 40px rgba(255, 182, 217, 0.25);
        border-radius: 22px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(10px);
    }

    .register-btn {
        background: linear-gradient(90deg, #ff8fb9 0%, #ffb6d9 100%);
        border: none;
        color: #fff;
        font-weight: 600;
        box-shadow: 0 6px 18px rgba(255, 143, 185, 0.35);
        transition: 0.3s;
    }

    .register-btn:hover {
        background: linear-gradient(90deg, #ff77ad 0%, #ffa6d1 100%);
        color: #fff;
        transform: translateY(-1px);
    }

    .register-link {
        color: #ff6fae;
        font-weight: 600;
    }

    .register-link:hover {
        color: #ff3f96;
        text-decoration: underline;
    }

    .btn-google-register {
        background: #fff5fb;
        border: 2px solid #ffc2dd;
        color: #ff4fa4;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-google-register:hover {
        background: #ffb6d9;
        color: #fff;
        border-color: #ff8fb9;
        transform: translateY(-1px);
    }
</style>

<script>
    document.body.classList.add('register-bg');
</script>

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">

        <div class="col-lg-5 col-md-8">
            <div class="register-glass p-5">

                <div class="text-center mb-4">
                    <h3 class="fw-bold mb-1" style="color:#ff4fa4">Buat Akun Baru</h3>
                    <p class="text-muted">Daftar sekarang untuk mulai belanja.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input id="name" type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}" required autofocus
                               placeholder="Nama lengkap kamu">

                        @error('name')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required
                               placeholder="nama@email.com">

                        @error('email')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required
                               placeholder="••••••••">

                        @error('password')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                        <input id="password-confirm" type="password"
                               class="form-control"
                               name="password_confirmation" required
                               placeholder="Ulangi password">
                    </div>

                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn register-btn btn-lg">
                            <i class="bi bi-person-plus-fill me-2"></i> Daftar
                        </button>
                    </div>

                    <div class="position-relative my-4">
                        <hr>
                        <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">
                            atau daftar dengan
                        </span>
                    </div>

                    <div class="d-grid mb-3">
                        <a href="{{ route('auth.google') }}"
                           class="btn btn-google-register btn-lg d-flex align-items-center justify-content-center gap-2">
                            <span class="bg-white rounded-circle shadow-sm d-flex align-items-center justify-content-center"
                                  style="width:36px;height:36px;">
                                <img src="https://www.svgrepo.com/show/475656/google-color.svg"
                                     width="22">
                            </span>
                            <span class="fw-semibold">Daftar dengan Google</span>
                        </a>
                    </div>

                    <p class="mt-4 text-center mb-0">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="register-link fw-bold">Login Sekarang</a>
                    </p>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
