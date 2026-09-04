<x-layout>
    <x-slot:title title="Cart">{{ $title }}</x-slot:title>
    <!-- Main Cart Content -->
    <main class="container mb-5">
        <div class="row g-4">
            <!-- Left Side: Cart Items List -->
            <div class="col-lg-8">
                <!-- Cart Header & Select All Controls -->
                {{-- <div class="cart-card p-3 mb-3">
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
                </div> --}}

                <!-- Cart Items Container -->
                <div id="cartListContainer" class="d-flex flex-column gap-3">
                    <div class="container my-4">
                        <div class="row">
                            <div class="col-12">
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if(session('errors'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach(session('errors')->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="col-12">
                                @php
                                    $cart_empty = $cartItems->isEmpty();
                                @endphp
                                @if($cart_empty)
                                    {{-- <p>Your cart is empty.</p> --}}
                                    {{-- <a href="{{ route('home') }}" class="btn btn-primary">Continue Shopping</a> --}}
                                    <!-- Empty Cart State (Hidden by default) -->
                                        <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 90px; height: 90px;">
                                            <i class="bi bi-cart-x fs-1"></i>
                                        </div>
                                        <h5 class="fw-bold text-dark mb-2">Keranjang Belanja Anda Kosong</h5>
                                        <p class="text-muted small mb-4">Wah, sepertinya Anda belum menambahkan produk apapun. Yuk, jelajahi ribuan produk terbaik kami!</p>
                                        <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold">
                                            <i class="bi bi-bag-plus me-1"></i> Mulai Belanja Sekarang
                                        </a>

                                @else
                                    <h1>Shopping Cart</h1>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cartItems as $cartItem)
                                                <tr>
                                                    <td>{{ $cartItem->product->name }}</td>
                                                    <td>
                                                        <form action="{{ route('carts.update', $cartItem->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" class="form-control" style="width: 80px; display: inline-block;"/>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="bi bi-pencil"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>Rp{{ number_format($cartItem->product->price, 0, ',', '.') }}</td>
                                                    <td>Rp{{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }}</td>
                                                    <td>
                                                        <form action="{{ route('carts.destroy', $cartItem->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this item from the cart?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Order Summary Panel -->
            <div class="col-lg-4">
                <div class="sticky-summary">
                    <!-- Summary Card -->
                    <div class="cart-card p-4">
                        <h5 class="fw-bold text-dark mb-3">Ringkasan Belanja</h5>

                        <div class="d-flex justify-content-between text-muted mb-2 small">
                            <span>Total Harga Barang</span>
                            <span id="summarySubtotal" class="fw-semibold text-dark">Rp{{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 0, ',', '.') }}</span>
                        </div>

                        {{-- <div class="d-flex justify-content-between text-muted mb-2 small">
                            <span>Diskon Voucher</span>
                            <span id="summaryDiscount" class="fw-semibold text-success">-Rp 50.000</span>
                        </div> --}}

                        {{-- <div class="d-flex justify-content-between text-muted mb-3 small">
                            <span>Estimasi Ongkos Kirim</span>
                            <span id="summaryShipping" class="fw-semibold text-dark">Rp 15.000</span>
                        </div> --}}

                        <hr class="my-3">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <span class="d-block fw-bold text-dark fs-6">Total Pembayaran</span>
                                <small class="text-muted" style="font-size: 0.75rem;">Termasuk Pajak & Biaya Tambahan</small>
                            </div>
                            <span id="summaryGrandTotal" class="fw-bold text-primary fs-4">Rp{{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 0, ',', '.') }}</span>
                        </div>

                        @if(!$cart_empty)
                            <button id="btnProceedCheckout" class="btn btn-primary w-100 py-2.5 rounded-3 fw-bold fs-6 d-flex justify-content-center align-items-center gap-2 mb-3 shadow-sm">
                                <span>Lanjut ke Pembayaran</span>
                                <i class="bi bi-arrow-right"></i>
                            </button>

                            <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100 py-2 rounded-3 fw-semibold small text-center d-block text-decoration-none">
                            <i class="bi bi-arrow-left me-1"></i> Tambah Produk Lain
                            </a>
                        @endif

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