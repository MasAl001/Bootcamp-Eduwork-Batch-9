<!-- Navbar Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-primary" href="#">
            <i class="bi bi-bag-heart-fill fs-3 text-primary"></i>
            <span class="text-white">Toko AL</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse mt-3 mt-lg-0" id="navbarContent">
            <!-- Search Form -->
            <div class="d-flex mx-auto col-lg-5 col-12 my-2 my-lg-0">
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control border-end-0 bg-light" placeholder="Cari nama produk, kategori..." onkeyup="filterProducts()">
                    <button class="btn btn-light border-start-0 text-muted" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>

            <!-- Navigation Action Right -->                
                <!-- Cart Trigger Button -->
                <button class="btn btn-light position-relative d-flex align-items-center gap-2 rounded-pill px-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
                    <i class="bi bi-cart3 fs-5"></i>
                    <span class="fw-semibold">Keranjang</span>
                    <span id="cartBadge" class="position-absolute top-0 inset-s-100 translate-middle badge rounded-pill bg-danger cart-badge">0</span>
                </button>
            </div>
        </div>
    </div>
</nav>