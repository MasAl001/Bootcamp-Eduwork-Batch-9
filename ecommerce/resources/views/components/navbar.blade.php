<!-- Navbar Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-primary" href="{{ url('/') }}">
            <i class="bi bi-bag-heart-fill fs-3 text-primary"></i>
            <span class="text-white">Toko AL</span>
        </a>
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
            <div class="d-flex align-items-center gap-3 ms-auto">              
                <!-- Cart Trigger Button -->
                <a href="{{ route('carts.index') }}" class="btn btn-light rounded-pill px-3 d-flex align-items-center gap-2">
                    <i class="bi bi-cart3 fs-5"></i>
                    <span class="fw-semibold">Keranjang</span>
                </a>
                <!-- Login/Register Button -->
                @guest
                <a href="{{ route('login') }}" class="btn btn-light rounded-pill px-3 d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-in-right fs-5"></i>
                    <span class="fw-semibold">Login</span>
                </a>
                @endguest
                @auth
                @if(Auth::user()->role === 'admin')
                <a href="{{ route('dashboard') }}" class="btn btn-light rounded-pill px-3 d-flex align-items-center gap-2">
                    <i class="bi bi-speedometer2 fs-5"></i>
                    <span class="fw-semibold">Dashboard</span>
                </a>
                @endif
                <a href="{{ route('profile.edit') }}" class="btn btn-light rounded-pill px-3 d-flex align-items-center gap-2">
                    <i class="bi bi-person fs-5"></i>
                    <span class="fw-semibold">Profile</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Are you sure you want to logout?')">
                    @csrf
                    <button type="submit" class="btn btn-light rounded-pill px-3 d-flex align-items-center gap-2">
                        <i class="bi bi-box-arrow-right fs-5"></i>
                        <span class="fw-semibold">Logout</span>
                    </button>
                </form>
                @endauth
            </div>
        </div>
    </div>
</nav>