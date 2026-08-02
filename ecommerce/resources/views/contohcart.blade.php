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
    <div class="toast-container position-fixed bottom-0 inset-e-0 p-3" style="z-index: 1100;">
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