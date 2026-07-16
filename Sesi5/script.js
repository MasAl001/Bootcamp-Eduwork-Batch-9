// Script JavaScript
// 1. Array Data Produk
const daftarProduk = [
    {
        nama: "Laptop ProBook 15",
        harga: 12500000,
        deskripsi: "Laptop tangguh untuk keperluan kerja dan desain grafis ringan.",
        kategori: "Elektronik",
        gambar: "https://picsum.photos/seed/laptop/400/300"
    },
    {
        nama: "Kemeja Flanel Kotak",
        harga: 150000,
        deskripsi: "Kemeja flanel berbahan katun yang nyaman dipakai seharian.",
        kategori: "Pakaian",
        gambar: "https://picsum.photos/seed/kemeja/400/300"
    },
    {
        nama: "Buku Pemrograman Web",
        harga: 85000,
        deskripsi: "Panduan lengkap belajar HTML, CSS, dan JavaScript dari nol.",
        kategori: "Buku",
        gambar: "https://picsum.photos/seed/bukuweb/400/300"
    },
    {
        nama: "Smartphone Galaxy Y",
        harga: 4300000,
        deskripsi: "Ponsel pintar dengan kamera jernih dan baterai tahan lama.",
        kategori: "Elektronik",
        gambar: "https://picsum.photos/seed/hp/400/300"
    },
    {
        nama: "Jaket Denim Klasik",
        harga: 250000,
        deskripsi: "Jaket denim stylish yang cocok dipadukan dengan berbagai gaya.",
        kategori: "Pakaian",
        gambar: "https://picsum.photos/seed/jaket/400/300"
    },
    {
        nama: "Novel Misteri: Hilang",
        harga: 65000,
        deskripsi: "Buku novel dengan alur cerita yang penuh teka-teki dan menegangkan.",
        kategori: "Buku",
        gambar: "https://picsum.photos/seed/novel/400/300"
    }
];

// Mendapatkan elemen wadah untuk produk
const wadahProduk = document.getElementById('wadah-produk');

// 2. Fungsi untuk menampilkan produk menggunakan Looping (forEach)
function tampilkanProduk(data) {
    // Kosongkan wadah terlebih dahulu
    wadahProduk.innerHTML = '';

    // Looping data array
    data.forEach(produk => {
        // Format angka menjadi format mata uang Rupiah
        const hargaRupiah = new Intl.NumberFormat('id-ID', { 
            style: 'currency', 
            currency: 'IDR',
            maximumFractionDigits: 0
        }).format(produk.harga);

        // Membuat elemen HTML untuk setiap produk (Menggunakan Card Bootstrap)
        const cardHTML = `
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm card-produk border-0">
                    <img src="${produk.gambar}" class="card-img-top gambar-produk" alt="">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title fw-bold mb-0">${produk.nama}</h5>
                        </div>
                        <span class="badge bg-secondary mb-2 align-self-start">${produk.kategori}</span>
                        <h6 class="text-primary fw-bold fs-5">${hargaRupiah}</h6>
                        <p class="card-text text-muted flex-grow-1">${produk.deskripsi}</p>
                        <button class="btn btn-outline-primary w-100 mt-2" onclick="alert('Anda memasukkan ${produk.nama} ke keranjang!')">
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>
        `;

        // Menyisipkan HTML ke dalam wadah utama
        wadahProduk.innerHTML += cardHTML;
    });

    // Tampilkan pesan jika data kosong (misal setelah difilter tidak ada hasil)
    if (data.length === 0) {
        wadahProduk.innerHTML = `
            <div class="col-12 text-center py-5">
                <h5 class="text-muted">Tidak ada produk dalam kategori ini.</h5>
            </div>
        `;
    }
}

// Tampilkan semua produk saat halaman pertama kali dimuat
tampilkanProduk(daftarProduk);

// 3. Fungsi Filter Kategori
function filterProduk() {
    // Ambil nilai kategori yang dipilih dari dropdown
    const kategoriPilihan = document.getElementById('filterKategori').value;

    // Jika memilih "Semua", kembalikan semua data produk asli
    if (kategoriPilihan === 'Semua') {
        tampilkanProduk(daftarProduk);
    } else {
        // Filter array berdasarkan kategori yang dipilih menggunakan .filter()
        const dataTersaring = daftarProduk.filter(produk => produk.kategori === kategoriPilihan);
        // Tampilkan data yang sudah difilter
        tampilkanProduk(dataTersaring);
    }
}
