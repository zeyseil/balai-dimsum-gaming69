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
<<<<<<< HEAD
    <link rel="stylesheet" href="popuporderstyle.css">
    <script src="{{ asset('menujs.js') }}"></script>
=======
    <style>
        <style>
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

        a {
    text-decoration: none;
}
    </style>

>>>>>>> 8fa66514f8c268bb1c2f772e25596f3bb1bdd512
</head>

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
@if (session('pesanan_dikirim'))
    <div id="popup-pembayaran">
        <div class="popup-box">
            <h3>Pesanan Berhasil</h3>
            <p>Pesanan kamu sudah dikirim dan menunggu verifikasi.</p>
            <button type="button" onclick="closePopupPembayaran()">OK</button>
        </div>
    </div>
@endif
</body>

</html> 