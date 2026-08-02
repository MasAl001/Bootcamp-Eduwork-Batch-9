<x-layout>
    <x-slot:title title="Cart">{{ $title }}</x-slot:title>
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
</x-layout>