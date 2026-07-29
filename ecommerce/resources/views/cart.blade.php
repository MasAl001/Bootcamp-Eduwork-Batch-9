<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - TokoKita</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../public/css/style.css">

</head>
<body>

    <!-- Navbar Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-primary" href="#">
                <i class="bi bi-bag-heart-fill fs-3 text-primary"></i>
                <span class="text-white">TokoKita</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse mt-3 mt-lg-0" id="navbarContent">
                <div class="d-flex mx-auto col-lg-5 col-12 my-2 my-lg-0">
                    <div class="input-group">
                        <input type="text" class="form-control border-end-0 bg-light" placeholder="Cari di TokoKita...">
                        <button class="btn btn-light border-start-0 text-muted" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end gap-3 ms-auto">
                    <a href="#" class="text-white text-decoration-none d-none d-md-inline-block">
                        <i class="bi bi-heart fs-5 me-1"></i> Wishlist
                    </a>
                    <a href="#" class="text-white text-decoration-none d-flex align-items-center gap-2">
                        <i class="bi bi-person-circle fs-5"></i>
                        <span class="d-none d-md-inline">Akun Saya</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb & Checkout Stepper Container -->
    <div class="bg-white border-bottom py-3 mb-4 shadow-sm">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 mb-2 mb-md-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 small">
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Beranda</a></li>
                            <li class="breadcrumb-item active text-primary fw-bold" aria-current="page">Keranjang Belanja</li>
                        </ol>
                    </nav>
                </div>
                
                <!-- Progress Stepper -->
                <div class="col-md-8">
                    <div class="cart-stepper justify-content-md-end">
                        <div class="stepper-step active">
                            <span class="stepper-circle">1</span>
                            <span>Keranjang</span>
                        </div>
                        <div class="stepper-line"></div>
                        <div class="stepper-step">
                            <span class="stepper-circle">2</span>
                            <span>Pengiriman</span>
                        </div>
                        <div class="stepper-line"></div>
                        <div class="stepper-step">
                            <span class="stepper-circle">3</span>
                            <span>Pembayaran</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Cart Content -->
    <main class="container mb-5">
        <div class="row g-4">
            <!-- Left Side: Cart Items List -->
            <div class="col-lg-8">
                
                <!-- Free Shipping Progress Banner -->
                <div class="free-shipping-card p-3 mb-4">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-truck fs-5 text-primary"></i>
                        <span id="freeShippingText" class="fw-bold text-dark small">Tambah Rp 150.000 lagi untuk mendapatkan Gratis Ongkir!</span>
                    </div>
                    <div class="progress" style="height: 8px; background-color: #cbd5e1;">
                        <div id="freeShippingBar" class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <!-- Cart Header & Select All Controls -->
                <div class="cart-card p-3 mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-check d-flex align-items-center gap-2 m-0">
                            <input class="form-check-input fs-5 mt-0" type="checkbox" id="selectAllCheckbox" checked onchange="toggleSelectAll(this)">
                            <label class="form-check-label fw-bold text-dark" for="selectAllCheckbox">
                                Pilih Semua (<span id="selectedCountText">3</span> Produk)
                            </label>
                        </div>
                        <button class="btn btn-sm btn-link text-danger text-decoration-none fw-semibold p-0" onclick="removeSelectedItems()">
                            <i class="bi bi-trash me-1"></i> Hapus Terpilih
                        </button>
                    </div>
                </div>

                <!-- Cart Items Container -->
                <div id="cartListContainer" class="d-flex flex-column gap-3">
                    <!-- Dynamic cart items rendered via JS -->
                </div>

                <!-- Empty Cart State (Hidden by default) -->
                <div id="emptyCartView" class="cart-card p-5 text-center d-none">
                    <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 90px; height: 90px;">
                        <i class="bi bi-cart-x fs-1"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Keranjang Belanja Anda Kosong</h5>
                    <p class="text-muted small mb-4">Wah, sepertinya Anda belum menambahkan produk apapun. Yuk, jelajahi ribuan produk terbaik kami!</p>
                    <a href="#" class="btn btn-primary rounded-pill px-4 py-2 fw-bold">
                        <i class="bi bi-bag-plus me-1"></i> Mulai Belanja Sekarang
                    </a>
                </div>

                <!-- Recommended Products Section -->
                <div class="mt-5">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="fw-bold m-0"><i class="bi bi-stars text-warning me-2"></i>Rekomendasi Pelengkap</h5>
                        <a href="#" class="text-decoration-none small fw-semibold text-primary">Lihat Lainnya <i class="bi bi-chevron-right"></i></a>
                    </div>

                    <div class="row g-3" id="recommendedGrid">
                        <!-- Recommended products injected via JS -->
                    </div>
                </div>

            </div>

            <!-- Right Side: Order Summary Panel -->
            <div class="col-lg-4">
                <div class="sticky-summary">
                    <!-- Voucher Promo Box -->
                    <div class="cart-card p-3 mb-3">
                        <label class="form-label fw-bold text-dark small mb-2"><i class="bi bi-ticket-perforated text-primary me-2"></i>Makin Hemat Pakai Promo</label>
                        <div class="input-group">
                            <input type="text" id="voucherCodeInput" class="form-control text-uppercase form-control-sm" placeholder="Kode Promo / Kupon" value="GAJIANFEST">
                            <button class="btn btn-primary btn-sm fw-bold px-3" type="button" onclick="applyVoucher()">Terapkan</button>
                        </div>
                        <div id="voucherMessage" class="small text-success mt-2 fw-semibold">
                            <i class="bi bi-check-circle-fill me-1"></i> Promo GAJIANFEST berhasil dipakai (-Rp 50.000)
                        </div>
                    </div>

                    <!-- Summary Card -->
                    <div class="cart-card p-4">
                        <h5 class="fw-bold text-dark mb-3">Ringkasan Belanja</h5>

                        <div class="d-flex justify-content-between text-muted mb-2 small">
                            <span>Total Harga (<span id="summaryTotalQty">3</span> barang)</span>
                            <span id="summarySubtotal" class="fw-semibold text-dark">Rp 3.100.000</span>
                        </div>

                        <div class="d-flex justify-content-between text-muted mb-2 small">
                            <span>Diskon Voucher</span>
                            <span id="summaryDiscount" class="fw-semibold text-success">-Rp 50.000</span>
                        </div>

                        <div class="d-flex justify-content-between text-muted mb-3 small">
                            <span>Estimasi Ongkos Kirim</span>
                            <span id="summaryShipping" class="fw-semibold text-dark">Rp 15.000</span>
                        </div>

                        <hr class="my-3">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <span class="d-block fw-bold text-dark fs-6">Total Pembayaran</span>
                                <small class="text-muted" style="font-size: 0.75rem;">Termasuk Pajak & Biaya Tambahan</small>
                            </div>
                            <span id="summaryGrandTotal" class="fw-bold text-primary fs-4">Rp 3.065.000</span>
                        </div>

                        <button id="btnProceedCheckout" class="btn btn-primary w-100 py-2.5 rounded-3 fw-bold fs-6 d-flex justify-content-center align-items-center gap-2 mb-3 shadow-sm" onclick="proceedToCheckout()">
                            <span>Lanjut ke Pengiriman</span>
                            <i class="bi bi-arrow-right"></i>
                        </button>

                        <a href="#" class="btn btn-outline-secondary w-100 py-2 rounded-3 fw-semibold small text-center d-block text-decoration-none">
                            <i class="bi bi-arrow-left me-1"></i> Tambah Produk Lain
                        </a>

                        <!-- Security Guarantees -->
                        <div class="border-top pt-3 mt-4">
                            <div class="d-flex align-items-center gap-3 mb-2 text-muted small">
                                <i class="bi bi-shield-check fs-4 text-success"></i>
                                <span>Jaminan 100% Produk Original & Bergaransi</span>
                            </div>
                            <div class="d-flex align-items-center gap-3 text-muted small">
                                <i class="bi bi-lock fs-4 text-primary"></i>
                                <span>Pembayaran Aman & Terenkripsi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-4 mt-auto">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h5 class="fw-bold text-primary mb-3">TokoKita</h5>
                    <p class="text-muted small">Destinasi belanja online nomor #1 di Indonesia dengan jaminan 100% barang original dan pengiriman super cepat.</p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Navigasi</h6>
                    <ul class="list-unstyled text-muted small d-flex flex-column gap-2">
                        <li><a href="#" class="text-decoration-none text-muted">Kategori Produk</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Promo Spesial</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Blog & Berita</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold mb-3">Layanan Pelanggan</h6>
                    <ul class="list-unstyled text-muted small d-flex flex-column gap-2">
                        <li><a href="#" class="text-decoration-none text-muted">Pusat Bantuan / FAQ</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Kebijakan Pengembalian</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Lacak Pengiriman</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold mb-3">Metode Pembayaran</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-secondary">BCA</span>
                        <span class="badge bg-secondary">Mandiri</span>
                        <span class="badge bg-secondary">QRIS</span>
                        <span class="badge bg-secondary">GoPay</span>
                    </div>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <p class="text-center text-muted small mb-0">&copy; 2026 TokoKita Indonesia. All rights reserved.</p>
        </div>
    </footer>

    <!-- Notification Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
        <div id="cartToast" class="toast align-items-center text-white bg-dark border-0 shadow" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center gap-2">
                    <i class="bi bi-info-circle-fill text-info fs-5" id="toastIcon"></i>
                    <span id="toastMessage">Pemberitahuan</span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>