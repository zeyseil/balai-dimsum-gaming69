<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Balai Dimsum</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&family=Jua&display=swap" rel="stylesheet">
    <link rel="stylesheet" href='style2.css'>
    <link rel="stylesheet" href="style1.css">
    <style>
        <style>
       
a {
    text-decoration: none;
}
   
.checkout-modal {
    
    position: fixed;
    top: 50%;           /* 50% dari atas */
    left: 50%;          /* 50% dari kiri */
    transform: translate(-50%, -50%);
    inset: 0;
    background: rgba(0,0,0,0.6);
    border: none;
    padding: 0;
    border-radius: 20px;

    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
}

#checkout-modal:hover{
    box-shadow: 0 20px 50px rgba(255, 255, 255, 0.25);
}

@keyframes scaleIn {
    from {
        transform: scale(0.8);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}


.checkout-modal::backdrop {
    background-color: rgba(0, 0, 0, 0.5);
}

.checkout-content {
    background: #fff;
    width: 400px;
    padding: 25px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    animation: scaleIn .3s ease;
    border : none;
    outline: none;
}

.checkout-header {
    text-align: center;
    color: #b91c1c;
    margin-bottom: 15px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
    color: #374151;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #D1D5DB;
    border-radius: 6px;
    font-size: 14px;
}

.form-group textarea {
    resize: vertical;
    min-height: 80px;
}

.order-summary {
    background-color: #F3F4F6;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 15px;
}

.order-summary-title {
    text-align: center;
    color: #b91c1c;
    margin-bottom: 15px;
}

.order-item-summary {
    font-size: 14px;
    color: #6B7280;
    margin-bottom: 5px;
}

.total-summary {
    font-size: 18px;
    font-weight: bold;
    color: #EF4444;
    text-align: right;
    margin-top: 10px;
    padding-top: 10px;
    border-top: 2px solid #E5E7EB;
}

.checkout-buttons {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.btn-submit,
.btn-cancel {
    flex: 1;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    font-size: 16px;
}

.btn-submit {
    background-color: #EF4444;
    color: white;
    background: linear-gradient(135deg, #EF4444, #DC2626);
    border-radius: 10px;
    transition: all 0.3s ease;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 22px rgba(239, 68, 68, 0.45);
    background: linear-gradient(135deg, #DC2626, #B91C1C);
}

.btn-submit:disabled {
    background-color: #9CA3AF;
    cursor: not-allowed;
}

.btn-submit,.btn-cancel:active {
    transform: scale(0.97);
    box-shadow: 0 4px 10px rgba(239, 68, 68, 0.35);
}

.btn-submit,.btn-cancel:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.3);
}

.btn-cancel {
    background-color: #E5E7EB;
    color: #374151;
    transition: all 0.3s ease;
}

.btn-cancel:hover {
    transform: translateY(-2px);
    background-color: #D1D5DB;
    box-shadow: 0 10px 22px rgba(239, 68, 68, 0.45);
}
/* === POPUP PEMBAYARAN === */
#popup-pembayaran {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

#popup-pembayaran * {
    all: unset;
    box-sizing: border-box;
    font-family: inherit;
}

#popup-pembayaran .popup-box {
    all: unset;
    background: #ffffff;
    padding: 24px 28px;
    border-radius: 8px;
    width: 90%;
    max-width: 420px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

#popup-pembayaran .popup-box h3 {
    display: block;
    font-size: 20px;
    margin-bottom: 10px;
    font-weight: 600;
}

#popup-pembayaran .popup-box p {
    display: block;
    font-size: 14px;
    line-height: 1.5;
}

#popup-pembayaran .popup-box button {
    display: inline-block;
    margin-top: 16px;
    padding: 8px 22px;
    border-radius: 4px;
    background: #111;
    color: #fff;
    cursor: pointer;
}
    </style>

</head>

<script>
    let currentItem = null; // variable item menu yang terpilih
let currentQty = 1; // jumlah stok default
let selectedType = 'reguler'; // tipe menu default

function tampilkanDialog(id, name, image, price_reguler, price_mini) {
    console.log('Dialog dibuka:', id, name, image, price_reguler, price_mini ); // debug ketika pop up terbuka
    
    currentItem = { // penginputan dari database menjadi variable berikut:
        id: id,
        name: name,
        image: image,
        price: [price_reguler, price_mini], // Array [reguler, mini]
        currentPrice: price_reguler // Default ke harga reguler
    };
    currentQty = 1;
    selectedType = 'reguler'; // default option
    
    // Update setiap konten yang terdapat pada dialog(pop up) dengan data item
    document.getElementById('dialog-image').src = image;
    document.getElementById('dialog-image').alt = name;
    document.getElementById('dialog-name').textContent = 'Dimsum ' + name + ' isi 5';
    document.getElementById('dialog-price').textContent = 'Rp ' + formatRupiah(price_reguler); // Tampilkan harga reguler(defaultnya)
    document.getElementById('qty-number').textContent = currentQty;
    document.getElementById('dialog-notes').value = '';
    
    // menu tombol tipe menu agar bisa di toggle(active).
    document.querySelectorAll('.opt-btn').forEach(btn => {
        btn.classList.remove('active');
        if (btn.dataset.type === 'reguler') {
            btn.classList.add('active');
        }
    });
    
    const dialog = document.getElementById('kotak-dialog');
    dialog.showModal();
}

// function menyembunyikan pop up dialog
function sembunyikanDialog() {
    const dialog = document.getElementById('kotak-dialog');
    dialog.close(); 
}

// mengubah jumlah item berdasarkan delta = kurang / tambah
function ubahJumlah(delta) {
    currentQty += delta;
    if (currentQty < 1) currentQty = 1;
    document.getElementById('qty-number').textContent = currentQty;
    updateHargaDialog();
}

// function untuk mengubah harga dialog berdasarkan tipe (reguler/mini)
function updateHargaDialog() {
    if (!currentItem) return;
    
    // Ambil harga berdasarkan tipe yang dipilih
    let hargaAkhir;
    if (selectedType === 'mini') {
        hargaAkhir = currentItem.price[1]; // price_mini
    } else {
        hargaAkhir = currentItem.price[0]; // price_reguler
    }
    
    // Update tampilan harga setiap mengubah tipe pesanan
    document.getElementById('dialog-price').textContent = 'Rp ' + formatRupiah(hargaAkhir);
    
    // Simpan harga sebenarnya(harga akhir)
    currentItem.currentPrice = hargaAkhir;
}

function formatRupiah(angka) { // function mengubah format nilai angkabiasa menjadi rupiah
    return new Intl.NumberFormat('id-ID').format(angka);
}

// function untuk mengubah orderan yang telah diinput pada order list
function removeOrder(imageUrl) {
    const ordersList = document.getElementById('orders-list');
    const orderItems = ordersList.querySelectorAll('.order-item');
    
    orderItems.forEach(item => {
        const img = item.querySelector('.menu-img');
        if (img && img.src === imageUrl) {
            item.remove();
        }
    });
}

function updateTotalHarga() {
    const ordersList = document.getElementById('orders-list');
    const orderItems = ordersList.querySelectorAll('.order-item');
    let total = 0;
    
    // Loop setiap order item dan ambil subtotal
    orderItems.forEach(item => {
        const subtotalText = item.querySelector('div:nth-child(3)').textContent;
        // Ambil angka dari text "Rp 15.000" menjadi 15000
        const subtotal = parseInt(item.dataset.subtotal) || 0;
        total += subtotal;
    });
    
    // Update tampilan total harga
    document.getElementById('total-harga').textContent = 'Rp ' + formatRupiah(total);
}

function tambahPesanan() {
    if (!currentItem) return;
    
    const notes = document.getElementById('dialog-notes').value;
    const hargaSatuan = currentItem.currentPrice || currentItem.price;
    
    const orderData = {
        item: currentItem,
        type: selectedType,
        quantity: currentQty,
        notes: notes,
        subtotal: hargaSatuan * currentQty
    };
    
    console.log('Pesanan ditambahkan:', orderData);
    
    tambahKePesanan(orderData);
    updateTotalHarga();
    sembunyikanDialog();

}

// Fungsi untuk mengumpulkan semua pesanan
function ambilSemuaPesanan() {
    const ordersList = document.getElementById('orders-list');
    const orderItems = ordersList.querySelectorAll('.order-item');
    const orders = [];
    
    orderItems.forEach(item => {

        
        // Ambil data dari setiap order item
        const itemData = {
            item_id: parseInt(item.dataset.itemId),
            nama_menu: item.dataset.namaMenu,
            type: item.dataset.type,
            quantity: parseInt(item.dataset.quantity),
            subtotal: parseInt(item.dataset.subtotal),
            notes: item.dataset.notes || ''
        };
        orders.push(itemData);
    });
    
    return orders;
}

//  
function tambahKePesanan(orderData) {
    const ordersList = document.getElementById('orders-list');
    
    // Hapus pesan "belum ada pesanan"
    const emptyMessage = ordersList.querySelector('div[style*="pesanan masuk disini"]');
    if (emptyMessage) {
        ordersList.innerHTML = '';
    }
    
    const orderId = 'order-' + Date.now();

    const orderItem = document.createElement('div');
    orderItem.className = 'order-item';
    orderItem.id = orderId;

    orderItem.dataset.itemId = String(orderData.item.id);
    orderItem.dataset.namaMenu = String(orderData.item.name);
    orderItem.dataset.type = String(orderData.type);
    orderItem.dataset.quantity = String(orderData.quantity);
    orderItem.dataset.subtotal = String(orderData.subtotal);
    orderItem.dataset.notes = String(orderData.notes || '');
    orderItem.dataset.priceReguler = String(orderData.item.price[0]); // Simpan harga reguler
    orderItem.dataset.priceMini = String(orderData.item.price[1]); // Simpan harga mini


    orderItem.dataset.subtotal = orderData.subtotal;
    orderItem.style.cssText = 'padding: 3px; border-bottom: 1px solid #E5E7EB; position: relative; cursor: pointer;';
    
    orderItem.innerHTML = `
        <div style="padding: 10px; border-bottom: 1px solid #E5E7EB;">
            <button class="delete-order-btn" data-order-id="${orderId}" title="Hapus">x</button>
            <div style="font-weight: 600;">${orderData.item.name} (${orderData.type})</div>
            <div style="font-size: 14px; color: #6B7280;">Qty: ${orderData.quantity}</div>
            <div style="font-size: 14px; color: #6B7280;">Rp ${formatRupiah(orderData.subtotal)}</div>
            ${orderData.notes ? `<div style="font-size: 12px; color: #9CA3AF;">Catatan: ${orderData.notes}</div>` : ''}
        </div>
    `;
    
    const deleteBtn = orderItem.querySelector('.delete-order-btn');
    deleteBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        console.log('Orderan ke: ', orderId, 'telah terhapus.');

        const itemToRemove = document.getElementById(orderId);
        if (itemToRemove) {
            itemToRemove.remove();
            updateTotalHarga();
            console.log('Order item dihapus:', orderId);

            const remainingOrders = ordersList.querySelectorAll('.order-item');
            if (remainingOrders.length === 0) {
                ordersList.innerHTML = '<div style="display: flex; justify-content: center; color: #6B7280;">pesanan masuk disini</div>';
                document.getElementById('total-harga').textContent = ('Rp 0');
            }
            
        }
    });
    
    orderItem.addEventListener('click', (e) => {
        if (!e.target.classList.contains('delete-order-btn')) {
            const priceReguler = parseFloat(orderItem.dataset.priceReguler);
            const priceMini = parseFloat(orderItem.dataset.priceMini);
            tampilkanDialog(orderData.item.id, orderData.item.name, orderData.item.image, priceReguler, priceMini);
        }
    });
    
    ordersList.appendChild(orderItem);

        setTimeout(() => {
        hitungTotalPesanan();
    }, 50);
}


document.addEventListener('DOMContentLoaded', function() {
    updateTotalHarga();
    // Handle tombol opsi
    document.querySelectorAll('.opt-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.opt-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            selectedType = this.dataset.type;
            updateHargaDialog();
        });
    });

    // Handle click outside dialog (agar bisa keluar dari pop up ketika menekan diluar kotak dialog)
    const dialog = document.getElementById('kotak-dialog');
    if (dialog) {
        dialog.addEventListener('click', function(event) {
            const rect = dialog.getBoundingClientRect();
            const isInDialog = (
                rect.top <= event.clientY &&
                event.clientY <= rect.top + rect.height &&
                rect.left <= event.clientX &&
                event.clientX <= rect.left + rect.width
            );
            
            if (!isInDialog) {
                sembunyikanDialog();
            }
        });
    }
});
    
</script>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
            <img src="./img/logodimsum.jpg" alt="Logo">
            </div>
            <nav>
                <a href="/">Home</a>
                <a href="/menu">Menu</a>
                <a href="/saran">Saran</a>
                <a href="/galeri">Galeri</a>
            </nav>
        </div>

        <!-- Hero Section -->
        <div class="hero-section">
            <div class="hero-overlay"></div>
            <div class="welcome-text">
                <h1>Selamat Datang di<br>Balai Dimsum</h1>
            </div>
        </div>

        <!-- Menu Section -->
<div class="menu-section">
            <div class="menu-container">
                <h2 class="menu-title">MENU</h2>
                <div class="menu-content">
                    <!-- Sidebar -->
                    <div class="menu-sidebar">
                        <h3 class="sidebar-title">Pesanan</h3>
                        <div class="menu-filter" id="orders-list">
                            <div style="display: flex; justify-content: center; color: #6B7280;">
                                pesanan masuk disini
                        </div>
                        </div>
                        <div style="padding: 15px; border-top: 2px solid #E5E7EB; margin-top: 10px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <span style="font-weight: 700; font-size: 16px;">Total:</span>
            <span id="total-harga" style="font-weight: 700; font-size: 18px; color: #EF4444;"></span>
        </div>
    </div>
                        <button class="order-btn" onclick="keForm()">Order</button>

                    </div>
        <!-- bagian menu grid dimana setiap menu yang terdapat di database akan di munculkan disini. -->
                    <div class="menu-grid" id="menu-grid"> 
                        @foreach ($menu as $item)
                        <div class="menu-item" style="box-sizing: border-box;">
                            <div class="menu-image"><img src="{{  asset(path:'storage/' . $item-> foto_menu) }}"></div>
                            <div class="menu-name">{{ $item->nama_menu }}</div>
                            <button class="menu-btn" onclick="tampilkanDialog('{{ $item->id }}', '{{ $item->nama_menu }}', '{{ asset(path:'storage/' . $item-> foto_menu) }}', '{{ $item->harga_reguler ?? 0 }}', '{{ $item->harga_mini ?? 0}}')">Tambahkan</button> 
                        </div>  @endforeach   
                    </div>
                </div>
            </div>
        </div>
<!-- ini adalah bagian pop up ketika menekan tombol 'tambahkan' pada halaman menu -->
        <dialog id="kotak-dialog" class="modal-dialog">  
        <div class="container">

    <div class="top-bar">
      <button class="back-btn" onclick="sembunyikanDialog()">&#8592;</button> 
      <span class="title">Menu Info</span>
    </div>

    <div class="image-box">
      <img id="dialog-image" src="" alt="" />
    </div>

    <div class="content">

      <h2 class="menu-name1" id="dialog-name">Dimsum isi 5</h2>
      <p class="price" id="dialog-price">Rp :</p>

      <div class="option-row">
        <button class="opt-btn" data-type="reguler">Reguler</button>
        <button class="opt-btn" data-type="mini">Mini</button>
      </div>

      <label class="notes-label">Notes :</label>
      <textarea class="notes-box" id="dialog-notes" placeholder="Catatan tambahan."></textarea>

      <div class="promo">
        <img src="img/dimsum2.png" class="promo-icon">
        <span>Dimsumkeun, let’s try our signature mentai!</span>
        <img src="img/dimsum4.png" class="promo-icon">
      </div>

      <div class="order-row">
        <span>Total Order :</span>
        <div class="qty">
          <button class="qty-btn" onclick="ubahJumlah(-1)">−</button>
          <span class="qty-num" id="qty-number">1</span>
          <button class="qty-btn" onclick="ubahJumlah(1)">+</button>
        </div>
      </div>
      <button class="tambah-btn" onclick="tambahPesanan()">Tambahkan</button>
    </dialog>

<!-- POP UP CHECKOUT -->
    <dialog id="checkout-modal" class="checkout-modal" style="border: none; outline: none; padding: 0; border-radius: 15px;">
    <div class="checkout-content">
        <h2 class="checkout-header">Form Checkout</h2>
        
        <form id="checkout-form" method="POST" action="{{ route('pesan.kirim') }}">
            @csrf
            
            <!-- Ringkasan Pesanan -->
            <div class="order-summary">
                <div class="order-summary-title">Ringkasan Pesanan:</div>
                <div id="checkout-order-list"></div>
                <div class="total-summary" id="checkout-total">Total: Rp 0</div>
            </div>
            
            <!-- Data Pelanggan -->
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" required placeholder="Masukkan nama lengkap">
            </div>
            
            <div class="form-group">
                <label for="telepon">No. Telepon *</label>
                <input type="tel" id="no_telepon" name="no_telepon" maxlength="15" required placeholder="08xxxxxxxxxx">
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat Pengiriman *</label>
                <textarea id="alamat" name="alamat" required placeholder="Masukkan alamat lengkap"></textarea>
            </div>
            
            <!-- Hidden inputs untuk data pesanan -->
            <input type="hidden" name="orders" id="orders-data">
            <input type="hidden" name="total_harga" id="total-harga-input">
            
            <!-- Tombol -->
            <div class="checkout-buttons">
                <button type="button" class="btn-cancel" onclick="tutupCheckout()">Batal</button>
                <button type="submit" class="btn-submit" id="submit-checkout">Konfirmasi Pesanan</button>
            </div>
        </form>
    </div>
</dialog>

        <!-- Tagline Section -->
        <div class="tagline-section">
            <div class="dimsum-deco dimsum1"><img src="img/dimsum1.png"></div>
            <div class="dimsum-deco dimsum2"><img src="img/dimsum1.png"></div>
            <div class="tagline-banner">
                <h2>Dimsumkeun, let's try our signature mentai!</h2>
            </div>
        </div>

        <!-- Content Cards -->
        <div class="content-section">
            <div class="cards-container">
                <div class="card">
                    <div class="card-header">FOOD</div>
                    <div class="card-image food-image"></div>
                    <div class="card-text">
                        Nikmati kelezatan dimsum mentai kami yang dibuat dengan bahan-bahan segar dan berkualitas. Setiap gigitan memberikan sensasi rasa yang memanjakan lidah.
                    </div>
                    <a href="/menu">
                    <div class="card-button">
                        <span >Pesan Sekarang</span>
                    </div></a>
                </div>

                <div class="card">
                    <div class="card-header">OUTLET</div>
                    <div class="card-image outlet-image"></div>
                    <div class="card-text">
                        Kunjungi kami di BANDUNG TIMUR, Jl. Pasir Impun No. 28. Lokasi strategis dan mudah dijangkau untuk menikmati dimsum favorit Anda.
                    </div>
                    <a href="https://maps.app.goo.gl/uKkpyGTYmCJcB38RA"
                        target="_blank">
                       <div class="card-button">
                        <span>Baca Selengkapnya</span>
                    </div></a>
                </div>

                <div class="card">
                    <div class="card-header">GALERI</div>
                    <div class="card-image gallery-image"></div>
                    <div class="card-text">
                        Lihat berbagai foto produk dan momen spesial kami. Dari proses pembuatan hingga penyajian dimsum yang menggugah selera.
                    </div>
                    <a href="/galeri"><div class="card-button">
                        <span>Baca Selengkapnya</span>
                    </div></a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer-bottom">
                <div class="copyright">Copyright 2025. All rights reserved.</div>
                <div class="footer-strip"></div>
        </div>
    </div>
    <script>

function keForm() {
    const orders = ambilSemuaPesanan();
    
    // Validasi: cek apakah ada pesanan
    if (orders.length === 0) {
        alert('Belum ada pesanan yang ditambahkan!');
        return;
    }
    
    // Ambil total harga
    const totalHargaText = document.getElementById('total-harga').textContent;
    const totalHarga = parseInt(totalHargaText.replace(/[^0-9]/g, ''));
    
    // Tampilkan ringkasan pesanan di modal
    const orderListHtml = orders.map(order => `
        <div class="order-item-summary">
            ${order.nama_menu} (${order.type}) - ${order.quantity}x - Rp ${formatRupiah(order.subtotal)}
        </div>
    `).join('');
    
    document.getElementById('checkout-order-list').innerHTML = orderListHtml;
    document.getElementById('checkout-total').textContent = 'Total: Rp ' + formatRupiah(totalHarga);
    
    // Simpan data ke hidden input
    document.getElementById('orders-data').value = JSON.stringify(orders);
    document.getElementById('total-harga-input').value = totalHarga;
    
    // Buka modal
    document.getElementById('checkout-modal').showModal();
}

// Fungsi untuk menutup modal checkout
function tutupCheckout() {
    document.getElementById('checkout-modal').close();
    document.getElementById('checkout-form').reset();
}

// Handle form submit
document.getElementById('checkout-form').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submit-checkout');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Memproses...';
});

// Close modal when clicking outside
document.getElementById('checkout-modal').addEventListener('click', function(event) {
    const rect = this.getBoundingClientRect();
    const isInDialog = (
        rect.top <= event.clientY &&
        event.clientY <= rect.top + rect.height &&
        rect.left <= event.clientX &&
        event.clientX <= rect.left + rect.width
    );
    
    if (!isInDialog) {
        tutupCheckout();
    }
});
</script>

@if (session('pesanan_dikirim'))
    <div id="popup-pembayaran">
        <div class="popup-box">
            <h3>Pesanan Berhasil</h3>
            <p>Pesanan kamu sudah dikirim dan menunggu verifikasi.</p>
            <button type="button" onclick="closePopupPembayaran()">OK</button>
        </div>
    </div>
@endif

<script>
function closePopupPembayaran() {
    const popup = document.getElementById('popup-pembayaran');
    if (popup) popup.style.display = 'none';
}
</script>


</body>


</html> 
