{{-- ======================================== 
FILE: resources/views/auth/forgot.blade.php 
FUNGSI: Halaman forgot password (request reset link)
======================================== --}}
@extends('layouts.app')

@section('content')

<style>
    body.forgot-bg {
        min-height: 100vh;
        background: linear-gradient(135deg, #ffe4ec 0%, #ffd9f7 100%);
        background-attachment: fixed;
    }

    .forgot-glass {
        background: rgba(255, 255, 255, 0.92);
        box-shadow: 0 10px 40px rgba(255, 182, 217, 0.25);
        border-radius: 22px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(10px);
    }

    .forgot-btn {
        background: linear-gradient(90deg, #ff8fb9 0%, #ffb6d9 100%);
        border: none;
        color: #fff;
        font-weight: 600;
        box-shadow: 0 6px 18px rgba(255, 143, 185, 0.35);
        transition: 0.3s;
    }

    .forgot-btn:hover {
        background: linear-gradient(90deg, #ff77ad 0%, #ffa6d1 100%);
        color: #fff;
        transform: translateY(-1px);
    }

    .forgot-link {
        color: #ff6fae;
        font-weight: 600;
    }

    .forgot-link:hover {
        color: #ff3f96;
        text-decoration: underline;
    }
</style>

<script>
    document.body.classList.add('forgot-bg');
</script>

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">

        <div class="col-lg-5 col-md-8">
            <div class="forgot-glass p-5">

                <div class="text-center mb-4">
                    <h3 class="fw-bold mb-1" style="color:#ff4fa4">Lupa Password?</h3>
                    <p class="text-muted">Masukkan email kamu untuk menerima link reset password.</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autofocus
                               placeholder="nama@email.com">

                        @error('email')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn forgot-btn btn-lg">
                            <i class="bi bi-envelope-fill me-2"></i> Kirim Link Reset Password
                        </button>
                    </div>

                    <p class="mt-4 text-center mb-0">
                        <a href="{{ route('login') }}" class="forgot-link fw-bold">
                            <i class="bi bi-box-arrow-in-left"></i> Kembali ke Login
                        </a>
                    </p>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
