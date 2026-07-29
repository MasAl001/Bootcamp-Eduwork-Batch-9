// Sample Product Database
const productsData = [
    {
        id: 1,
        title: "Wireless Noise Cancelling Headphone",
        category: "Elektronik",
        price: 1850000,
        rating: 4.8,
        sold: 1420,
        discount: 15,
        image: "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&auto=format&fit=crop&q=80",
        badge: "Terlaris"
    },
    {
        id: 2,
        title: "Smartwatch Sport GPS Unisex Waterproof",
        category: "Elektronik",
        price: 950000,
        rating: 4.6,
        sold: 830,
        discount: 0,
        image: "https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&auto=format&fit=crop&q=80",
        badge: "Baru"
    },
    {
        id: 3,
        title: "Sepatu Sneaker Classic Casual White",
        category: "Fashion",
        price: 450000,
        rating: 4.9,
        sold: 2300,
        discount: 20,
        image: "https://images.unsplash.com/photo-1549298916-b41d501d3772?w=500&auto=format&fit=crop&q=80",
        badge: "Diskon"
    },
    {
        id: 4,
        title: "Tas Ransel Laptop Modern Waterproof 15.6 inch",
        category: "Fashion",
        price: 320000,
        rating: 4.7,
        sold: 540,
        discount: 10,
        image: "https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=500&auto=format&fit=crop&q=80",
        badge: ""
    },
    {
        id: 5,
        title: "Mesin Kopi Espresso Automatic Home Barista",
        category: "Lifestyle",
        price: 3450000,
        rating: 4.9,
        sold: 190,
        discount: 5,
        image: "https://images.unsplash.com/photo-1517668808822-9ebb02f2a0e6?w=500&auto=format&fit=crop&q=80",
        badge: "Premium"
    },
    {
        id: 6,
        title: "Botol Minum Termos Vacuum Insulated 1 Liter",
        category: "Lifestyle",
        price: 135000,
        rating: 4.5,
        sold: 3100,
        discount: 0,
        image: "https://images.unsplash.com/photo-1602143407151-7111542de6e8?w=500&auto=format&fit=crop&q=80",
        badge: ""
    },
    {
        id: 7,
        title: "Keyboard Mekanikal Gaming RGB Wireless",
        category: "Elektronik",
        price: 780000,
        rating: 4.8,
        sold: 980,
        discount: 25,
        image: "https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=500&auto=format&fit=crop&q=80",
        badge: "Diskon"
    },
    {
        id: 8,
        title: "Kacamata Hitam Polarized UV400 Protection",
        category: "Fashion",
        price: 180000,
        rating: 4.4,
        sold: 670,
        discount: 0,
        image: "https://images.unsplash.com/photo-1511499767150-a48a237f0083?w=500&auto=format&fit=crop&q=80",
        badge: ""
    }
];

// Global State
let cart = [];
let filteredProducts = [...productsData];

// Format Currency Helper (IDR)
function formatRupiah(amount) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        maximumFractionDigits: 0
    }).format(amount);
}

// Render Products Grid
function renderProducts(items) {
    const container = document.getElementById("productGrid");
    document.getElementById("productCount").innerText = items.length;

    if (items.length === 0) {
        container.innerHTML = `
            <div class="col-12 text-center py-5">
                <i class="bi bi-emoji-frown fs-1 text-muted mb-3 d-block"></i>
                <h5 class="fw-bold text-muted">Produk tidak ditemukan</h5>
                <p class="small text-muted">Coba ubah kata kunci atau reset filter pencarian Anda.</p>
            </div>
        `;
        return;
    }

    container.innerHTML = items.map(product => {
        const finalPrice = product.discount > 0 
            ? product.price * (1 - product.discount / 100) 
            : product.price;

        return `
            <div class="col-6 col-md-4 col-xl-3">
                <div class="card product-card h-100 shadow-sm">
                    <div class="product-img-wrapper">
                        ${product.discount > 0 ? `<span class="badge bg-danger badge-discount">Diskon ${product.discount}%</span>` : ''}
                        <button class="btn-wishlist" onclick="toggleWishlist(this)"><i class="bi bi-heart"></i></button>
                        <img src="${product.image}" alt="${product.title}" loading="lazy" onerror="this.src='https://placehold.co/400x300?text=Produk'">
                    </div>
                    <div class="card-body d-flex flex-column p-3">
                        <span class="badge bg-light text-secondary w-auto align-self-start mb-2">${product.category}</span>
                        <h6 class="card-title fw-semibold text-truncate mb-1" title="${product.title}">${product.title}</h6>
                        
                        <div class="d-flex align-items-center gap-1 mb-2">
                            <i class="bi bi-star-fill text-warning small"></i>
                            <span class="small fw-bold">${product.rating}</span>
                            <span class="small text-muted">(${product.sold})</span>
                        </div>

                        <div class="mt-auto pt-2">
                            ${product.discount > 0 ? `<small class="text-muted text-decoration-line-through d-block">${formatRupiah(product.price)}</small>` : ''}
                            <div class="fw-bold text-primary fs-6">${formatRupiah(finalPrice)}</div>
                            
                            <button class="btn btn-outline-primary btn-sm w-100 mt-2 rounded-pill fw-semibold d-flex justify-content-center align-items-center gap-1" onclick="addToCart(${product.id})">
                                <i class="bi bi-cart-plus"></i> + Keranjang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }).join('');
}

// Filter & Sort Logic
function filterProducts() {
    const searchQuery = document.getElementById("searchInput").value.toLowerCase();
    const selectedCategory = document.querySelector('input[name="category"]:checked').value;
    const maxPrice = parseFloat(document.getElementById("priceRange").value);
    const minRating = parseFloat(document.getElementById("ratingFilter").value);
    const sortBy = document.getElementById("sortBy").value;

    filteredProducts = productsData.filter(product => {
        const finalPrice = product.discount > 0 ? product.price * (1 - product.discount / 100) : product.price;
        
        const matchesSearch = product.title.toLowerCase().includes(searchQuery) || product.category.toLowerCase().includes(searchQuery);
        const matchesCategory = selectedCategory === "All" || product.category === selectedCategory;
        const matchesPrice = finalPrice <= maxPrice;
        const matchesRating = product.rating >= minRating;

        return matchesSearch && matchesCategory && matchesPrice && matchesRating;
    });

    // Sorting
    if (sortBy === "price-low") {
        filteredProducts.sort((a, b) => (a.price * (1 - a.discount/100)) - (b.price * (1 - b.discount/100)));
    } else if (sortBy === "price-high") {
        filteredProducts.sort((a, b) => (b.price * (1 - b.discount/100)) - (a.price * (1 - a.discount/100)));
    } else if (sortBy === "rating") {
        filteredProducts.sort((a, b) => b.rating - a.rating);
    }

    renderProducts(filteredProducts);
}

function updatePriceLabel(value) {
    document.getElementById("priceLabel").innerText = formatRupiah(value);
}

function resetFilters() {
    document.getElementById("searchInput").value = "";
    document.getElementById("catAll").checked = true;
    document.getElementById("priceRange").value = 15000000;
    document.getElementById("priceLabel").innerText = formatRupiah(15000000);
    document.getElementById("ratingFilter").value = "0";
    document.getElementById("sortBy").value = "default";
    filterProducts();
}

// Add Item to Cart
function addToCart(productId) {
    const product = productsData.find(p => p.id === productId);
    const existingIndex = cart.findIndex(item => item.id === productId);

    const finalPrice = product.discount > 0 
        ? product.price * (1 - product.discount / 100) 
        : product.price;

    if (existingIndex > -1) {
        cart[existingIndex].qty += 1;
    } else {
        cart.push({
            id: product.id,
            title: product.title,
            price: finalPrice,
            image: product.image,
            qty: 1
        });
    }

    updateCartUI();
    showToast();
}

// Update Cart UI Drawer
function updateCartUI() {
    const container = document.getElementById("cartItemsContainer");
    const badge = document.getElementById("cartBadge");
    const subtotalEl = document.getElementById("cartSubtotal");
    const totalEl = document.getElementById("cartTotal");
    const btnCheckout = document.getElementById("btnCheckout");

    const totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);

    badge.innerText = totalQty;

    if (cart.length === 0) {
        container.innerHTML = `
            <div class="text-center py-5">
                <i class="bi bi-cart-x fs-1 text-muted mb-2 d-block"></i>
                <p class="text-muted mb-0">Keranjang belanja Anda masih kosong.</p>
            </div>
        `;
        btnCheckout.disabled = true;
        subtotalEl.innerText = formatRupiah(0);
        totalEl.innerText = formatRupiah(0);
        return;
    }

    btnCheckout.disabled = false;

    container.innerHTML = cart.map((item, index) => `
        <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
            <img src="${item.image}" alt="${item.title}" class="cart-item-img">
            <div class="flex-grow-1">
                <h6 class="mb-1 small fw-bold text-truncate" style="max-width: 180px;">${item.title}</h6>
                <div class="text-primary fw-bold small">${formatRupiah(item.price)}</div>
                <div class="d-flex align-items-center gap-2 mt-2">
                    <div class="btn-group btn-group-sm border rounded">
                        <button class="btn btn-light py-0 px-2" onclick="changeQty(${index}, -1)">-</button>
                        <span class="px-2 py-0 small fw-bold d-flex align-items-center">${item.qty}</span>
                        <button class="btn btn-light py-0 px-2" onclick="changeQty(${index}, 1)">+</button>
                    </div>
                </div>
            </div>
            <button class="btn btn-sm text-danger border-0" onclick="removeItem(${index})"><i class="bi bi-trash"></i></button>
        </div>
    `).join('');

    subtotalEl.innerText = formatRupiah(subtotal);
    totalEl.innerText = formatRupiah(subtotal);
}

function changeQty(index, delta) {
    cart[index].qty += delta;
    if (cart[index].qty <= 0) {
        cart.splice(index, 1);
    }
    updateCartUI();
}

function removeItem(index) {
    cart.splice(index, 1);
    updateCartUI();
}

function showToast() {
    const toastEl = document.getElementById('cartToast');
    const toast = new bootstrap.Toast(toastEl, { delay: 2000 });
    toast.show();
}

function toggleWishlist(btn) {
    const icon = btn.querySelector('i');
    if (icon.classList.contains('bi-heart')) {
        icon.classList.remove('bi-heart');
        icon.classList.add('bi-heart-fill', 'text-danger');
    } else {
        icon.classList.remove('bi-heart-fill', 'text-danger');
        icon.classList.add('bi-heart');
    }
}

// Checkout Step Flow
function openCheckoutModal() {
    const cartOffcanvasEl = document.getElementById('cartOffcanvas');
    const offcanvas = bootstrap.Offcanvas.getInstance(cartOffcanvasEl);
    if (offcanvas) offcanvas.hide();

    updateCheckoutSummary();
    goToStep(1);

    const checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
    checkoutModal.show();
}

function goToStep(stepNumber) {
    document.getElementById('checkoutStep1').classList.add('d-none');
    document.getElementById('checkoutStep2').classList.add('d-none');
    document.getElementById('checkoutStep3').classList.add('d-none');

    document.getElementById('stepIndicator1').classList.remove('active');
    document.getElementById('stepIndicator2').classList.remove('active');
    document.getElementById('stepIndicator3').classList.remove('active');

    if (stepNumber === 1) {
        document.getElementById('checkoutStep1').classList.remove('d-none');
        document.getElementById('stepIndicator1').classList.add('active');
    } else if (stepNumber === 2) {
        document.getElementById('checkoutStep2').classList.remove('d-none');
        document.getElementById('stepIndicator1').classList.add('active');
        document.getElementById('stepIndicator2').classList.add('active');
    } else if (stepNumber === 3) {
        document.getElementById('checkoutStep3').classList.remove('d-none');
        document.getElementById('stepIndicator1').classList.add('active');
        document.getElementById('stepIndicator2').classList.add('active');
        document.getElementById('stepIndicator3').classList.add('active');
    }
}

function selectPayment(type, element) {
    document.querySelectorAll('.payment-option-card').forEach(card => card.classList.remove('active'));
    element.classList.add('active');
    element.querySelector('input[type="radio"]').checked = true;
}

function updateCheckoutSummary() {
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
    const shippingCost = parseFloat(document.getElementById('shippingMethod').value || 15000);
    const grandTotal = subtotal + shippingCost;

    document.getElementById('summarySubtotal').innerText = formatRupiah(subtotal);
    document.getElementById('summaryShipping').innerText = formatRupiah(shippingCost);
    document.getElementById('summaryGrandTotal').innerText = formatRupiah(grandTotal);

    const itemsContainer = document.getElementById('checkoutItemsList');
    itemsContainer.innerHTML = cart.map(item => `
        <div class="d-flex justify-content-between align-items-center small mb-2">
            <span class="text-truncate" style="max-width: 250px;">${item.title} <strong>x${item.qty}</strong></span>
            <span class="fw-semibold">${formatRupiah(item.price * item.qty)}</span>
        </div>
    `).join('');
}

function handleFormSubmit(e) {
    e.preventDefault();

    const checkoutModalEl = document.getElementById('checkoutModal');
    const checkoutModal = bootstrap.Modal.getInstance(checkoutModalEl);
    checkoutModal.hide();

    const randomInvoice = '#TK-' + Math.floor(100000 + Math.random() * 900000);
    document.getElementById('orderInvoice').innerText = randomInvoice;

    cart = [];
    updateCartUI();

    setTimeout(() => {
        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    }, 300);
}

// Initialize App
window.onload = function() {
    renderProducts(productsData);
    updateCartUI();
};
