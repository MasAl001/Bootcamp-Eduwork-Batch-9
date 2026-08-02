<x-layout>
    <x-slot:title title="Home">{{ $title }}</x-slot:title>
    <!-- Main Content -->
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
</x-layout>