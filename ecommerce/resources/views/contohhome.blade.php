<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko AL - Toko Online Modern</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../../public/css/style.css">

</head>
<body>

    <!-- ==========================================
         BAGIAN UTAMA HTML: index.html
         ========================================== -->
    <!-- Include Navbar Component -->
    <x-navbar />

    <!-- Main Content Container -->
    <div class="container mb-5" id="products-section">
        <div class="row g-4">
            <!-- Products Grid Section -->
            <main class="col">
                <!-- Sorting Bar -->
                <div class="card border-0 shadow-sm rounded-3 p-3 mb-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <p class="mb-0 text-muted"><span id="productCount" class="fw-bold text-dark">0</span> Produk ditemukan</p>
                        
                        <div class="d-flex align-items-center gap-2">
                            <label for="sortBy" class="small text-muted text-nowrap">Urutkan:</label>
                            <select id="sortBy" class="form-select form-select-sm" onchange="filterProducts()">
                                <option value="default">Paling Relevan</option>
                                <option value="price-low">Harga: Rendah ke Tinggi</option>
                                <option value="price-high">Harga: Tinggi ke Rendah</option>
                                <option value="rating">Rating Tertinggi</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Products Row Container -->
                <div class="row g-3" id="productGrid">
                    <!-- Cards injection via JS -->
                </div>
            </main>
        </div>
    </div>

    <!-- Shopping Cart Offcanvas (Slide Drawer) -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold" id="cartOffcanvasLabel">
                <i class="bi bi-cart-check me-2 text-primary"></i>Keranjang Belanja
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body d-flex flex-column justify-content-between p-3">
            <!-- List Items Container -->
            <div id="cartItemsContainer" class="grow overflow-auto">
                <!-- Cart items inserted here -->
            </div>

            <!-- Cart Summary & Checkout Action -->
            <div class="border-top pt-3 mt-2">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal</span>
                    <span id="cartSubtotal" class="fw-semibold">Rp 0</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Estimasi Pajak & Biaya</span>
                    <span class="text-success fw-semibold">Bebas Biaya</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <span class="fw-bold fs-5">Total Pembayaran</span>
                    <span id="cartTotal" class="fw-bold fs-5 text-primary">Rp 0</span>
                </div>

                <button id="btnCheckout" class="btn btn-primary w-100 py-2.5 rounded-3 fw-bold d-flex justify-content-center align-items-center gap-2" onclick="openCheckoutModal()" disabled>
                    <span>Lanjut ke Checkout</span>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Multi-step Checkout Modal -->
    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Proses Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <!-- Checkout Progress Indicators -->
                    <div class="step-indicator px-md-4">
                        <div class="step-item active" id="stepIndicator1">
                            <span class="step-number">1</span> Alamat Pengiriman
                        </div>
                        <div class="step-item" id="stepIndicator2">
                            <span class="step-number">2</span> Pembayaran
                        </div>
                        <div class="step-item" id="stepIndicator3">
                            <span class="step-number">3</span> Ringkasan
                        </div>
                    </div>

                    <form id="checkoutForm" onsubmit="handleFormSubmit(event)">
                        <!-- STEP 1: Shipping Address -->
                        <div id="checkoutStep1">
                            <h6 class="fw-bold mb-3"><i class="bi bi-geo-alt me-2 text-primary"></i>Informasi Alamat</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Nama Lengkap</label>
                                    <input type="text" class="form-control" required placeholder="Budi Santoso">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Nomor Telepon/WhatsApp</label>
                                    <input type="tel" class="form-control" required placeholder="081234567890">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small text-muted">Alamat Lengkap</label>
                                    <textarea class="form-control" rows="2" required placeholder="Jl. Sudirman No. 45, RT 02/RW 05"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Kota / Kabupaten</label>
                                    <input type="text" class="form-control" required placeholder="Jakarta Selatan">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Pilih Kurir Pengiriman</label>
                                    <select class="form-select" id="shippingMethod" onchange="updateCheckoutSummary()">
                                        <option value="15000">JNE Reguler (Rp 15.000) - 2-3 Hari</option>
                                        <option value="25000">SiCepat BEST (Rp 25.000) - 1 Hari</option>
                                        <option value="35000">GoSend Instant (Rp 35.000) - Hari Ini</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <button type="button" class="btn btn-primary px-4 rounded-3" onclick="goToStep(2)">Lanjut ke Pembayaran <i class="bi bi-arrow-right ms-1"></i></button>
                            </div>
                        </div>

                        <!-- STEP 2: Payment Method -->
                        <div id="checkoutStep2" class="d-none">
                            <h6 class="fw-bold mb-3"><i class="bi bi-credit-card me-2 text-primary"></i>Pilih Metode Pembayaran</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="payment-option-card p-3 d-flex align-items-center gap-3 active" onclick="selectPayment('qris', this)">
                                        <input type="radio" name="paymentMethod" value="QRIS" checked>
                                        <div>
                                            <div class="fw-bold">QRIS Instant</div>
                                            <small class="text-muted">BCA, Mandiri, GoPay, OVO, ShopeePay</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="payment-option-card p-3 d-flex align-items-center gap-3" onclick="selectPayment('bca', this)">
                                        <input type="radio" name="paymentMethod" value="Transfer Bank BCA">
                                        <div>
                                            <div class="fw-bold">Virtual Account BCA</div>
                                            <small class="text-muted">Verifikasi Otomatis 24 Jam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="payment-option-card p-3 d-flex align-items-center gap-3" onclick="selectPayment('ewallet', this)">
                                        <input type="radio" name="paymentMethod" value="E-Wallet">
                                        <div>
                                            <div class="fw-bold">GoPay / OVO</div>
                                            <small class="text-muted">Direct App Redirect</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="payment-option-card p-3 d-flex align-items-center gap-3" onclick="selectPayment('cod', this)">
                                        <input type="radio" name="paymentMethod" value="COD (Bayar di Tempat)">
                                        <div>
                                            <div class="fw-bold">COD (Bayar di Tempat)</div>
                                            <small class="text-muted">Bayar saat barang sampai</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary px-4 rounded-3" onclick="goToStep(1)"><i class="bi bi-arrow-left me-1"></i> Kembali</button>
                                <button type="button" class="btn btn-primary px-4 rounded-3" onclick="goToStep(3)">Lanjut ke Ringkasan <i class="bi bi-arrow-right ms-1"></i></button>
                            </div>
                        </div>

                        <!-- STEP 3: Order Summary & Confirmation -->
                        <div id="checkoutStep3" class="d-none">
                            <h6 class="fw-bold mb-3"><i class="bi bi-receipt me-2 text-primary"></i>Ringkasan Pesanan</h6>
                            
                            <div class="bg-light p-3 rounded-3 mb-3">
                                <div id="checkoutItemsList" class="mb-3">
                                    <!-- Checkout mini list injected via JS -->
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between small text-muted mb-1">
                                    <span>Subtotal Produk</span>
                                    <span id="summarySubtotal">Rp 0</span>
                                </div>
                                <div class="d-flex justify-content-between small text-muted mb-1">
                                    <span>Ongkos Kirim</span>
                                    <span id="summaryShipping">Rp 0</span>
                                </div>
                                <div class="d-flex justify-content-between fw-bold fs-5 mt-2 pt-2 border-top">
                                    <span>Total Bayar</span>
                                    <span id="summaryGrandTotal" class="text-primary">Rp 0</span>
                                </div>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="termsCheck" required>
                                <label class="form-check-label small text-muted" for="termsCheck">
                                    Saya menyetujui syarat dan ketentuan transaksi di TokoKita.
                                </label>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary px-4 rounded-3" onclick="goToStep(2)"><i class="bi bi-arrow-left me-1"></i> Kembali</button>
                                <button type="submit" class="btn btn-success px-4 rounded-3 fw-bold"><i class="bi bi-check-circle me-1"></i> Konfirmasi & Bayar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 text-center p-4">
                <div class="modal-body">
                    <div class="bg-success-subtle text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-check-lg fs-1"></i>
                    </div>
                    <h4 class="fw-bold mb-2">Pesanan Berhasil Dibuat!</h4>
                    <p class="text-muted small">Nomor Transaksi: <strong id="orderInvoice">#TK-892341</strong></p>
                    <p class="text-muted small mb-4">Terima kasih telah berbelanja di TokoKita. Instruksi pembayaran telah dikirimkan ke kontak Anda.</p>
                    <button type="button" class="btn btn-primary px-4 rounded-3 w-100 fw-bold" data-bs-dismiss="modal">Kembali Belanja</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Toast -->
    <div class="toast-container position-fixed bottom-0 inset-end-0 p-3" style="z-index: 1100;">
        <div id="cartToast" class="toast align-items-center text-white bg-dark border-0 shadow" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill text-success fs-5"></i>
                    <span>Produk berhasil ditambahkan ke keranjang!</span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Include Footer Component -->
    <x-footer />

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="../../public/js/script.js"></script>
</body>
</html>