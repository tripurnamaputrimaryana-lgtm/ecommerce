{{-- ================================================
FILE: resources/views/partials/footer.blade.php
THEME: Pink Elegant Premium
================================================ --}}

<style>
.footer-pink {
    background: linear-gradient(135deg, #ff4f9a, #ff7fbf);
    color: #fff;
}

.footer-pink a {
    color: rgba(255,255,255,.85);
    transition: .3s;
}

.footer-pink a:hover {
    color: #fff;
    text-decoration: none;
}

.footer-title {
    font-weight: 700;
    letter-spacing: .5px;
}

.footer-desc {
    color: rgba(255,255,255,.9);
    font-size: 14px;
}

.footer-social a {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: rgba(255,255,255,.2);
    display: flex;
    align-items: center;
    justify-content: center;
}

.footer-social a:hover {
    background: rgba(255,255,255,.35);
}

.footer-divider {
    border-color: rgba(255,255,255,.3);
}
</style>

<footer class="footer-pink pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row g-4">

            {{-- Brand --}}
            <div class="col-lg-4 col-md-6">
                <h5 class="footer-title mb-3">
                    <i class="bi bi-bag-heart-fill me-2"></i>
                    TokoOnline
                </h5>
                <p class="footer-desc">
                    Toko parfum online terpercaya dengan koleksi wangi premium,
                    elegan, dan original.
                </p>

                <div class="d-flex gap-3 mt-3 footer-social">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            {{-- Menu --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="footer-title mb-3">Menu</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('daftarproduk.index') }}">
                            <i class="bi bi-chevron-right me-1"></i>
                            Katalog Produk
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#">
                            <i class="bi bi-chevron-right me-1"></i>
                            Tentang Kami
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#">
                            <i class="bi bi-chevron-right me-1"></i>
                            Kontak
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Bantuan --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="footer-title mb-3">Bantuan</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#">
                            <i class="bi bi-question-circle me-1"></i>
                            FAQ
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#">
                            <i class="bi bi-cart-check me-1"></i>
                            Cara Belanja
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#">
                            <i class="bi bi-shield-check me-1"></i>
                            Kebijakan Privasi
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Kontak --}}
            <div class="col-lg-4 col-md-6">
                <h6 class="footer-title mb-3">Hubungi Kami</h6>
                <ul class="list-unstyled footer-desc">
                    <li class="mb-2">
                        <i class="bi bi-geo-alt me-2"></i>
                        Bandung, Indonesia
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone me-2"></i>
                        (022) 123-4567
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-envelope me-2"></i>
                        info@tokoonline.com
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-4 footer-divider">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <small>
                    &copy; {{ date('Y') }} TokoOnline · All Rights Reserved
                </small>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <i class="bi bi-credit-card me-2"></i>
                <i class="bi bi-wallet2 me-2"></i>
                <i class="bi bi-bank"></i>
            </div>
        </div>
    </div>
</footer>
