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
</head>

<script>
    let currentItem = null;
    let currentQty = 1;
    let selectedType = 'reguler';

    function tampilkanDialog(id, name, image, price) {
        console.log('Dialog dibuka:', id, name, image, price); // Debug
        
        currentItem = {
            id: id,
            name: name,
            image: image,
            price: price
        };
        currentQty = 1;
        selectedType = 'reguler';
        
        // Update konten dialog dengan data item
        document.getElementById('dialog-image').src = image;
        document.getElementById('dialog-image').alt = name;
        document.getElementById('dialog-name').textContent = 'Dimsum ' + name + ' isi 5';
        document.getElementById('dialog-price').textContent = 'Rp ' + formatRupiah(price);
        document.getElementById('qty-number').textContent = currentQty;
        document.getElementById('dialog-notes').value = '';
        
        // Reset pilihan type
        document.querySelectorAll('.opt-btn').forEach(btn => {
            btn.classList.remove('active');
            if (btn.dataset.type === 'reguler') {
                btn.classList.add('active');
            }
        });

        
        
        const dialog = document.getElementById('kotak-dialog');
        dialog.showModal(); // Ubah dari show() ke showModal()

        
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

    function sembunyikanDialog() {
        const dialog = document.getElementById('kotak-dialog');
        dialog.close();
    }

    

    function ubahJumlah(delta) {
        currentQty += delta;
        if (currentQty < 1) currentQty = 1;
        document.getElementById('qty-number').textContent = currentQty;
    }

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka);
    }

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
    // Handle pilihan type (Reguler/Mini)
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.opt-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.opt-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                selectedType = this.dataset.type;
            });
        });
    });



    function tambahPesanan() {
        if (!currentItem) return;
        
        const notes = document.getElementById('dialog-notes').value;
        const orderData = {
            item: currentItem,
            type: selectedType,
            quantity: currentQty,
            notes: notes,
            subtotal: currentItem.price * currentQty
        };
        
        console.log('Pesanan ditambahkan:', orderData); // Debug
        
        // Tambahkan ke daftar pesanan
        tambahKePesanan(orderData);
        
        // Tutup dialog
        sembunyikanDialog();
    }

    function tambahKePesanan(orderData) {
        const ordersList = document.getElementById('orders-list');
        
        // Hapus pesan "belum ada pesanan" jika ada
        const emptyMessage = ordersList.querySelector('div[style*="pesanan masuk disini"]');
        if (emptyMessage) {
            ordersList.innerHTML = '';
        }
        
        const orderId = 'order-' + Date.now();

        // Buat elemen pesanan baru
        const orderItem = document.createElement('div');
        orderItem.className = 'order-item';
        orderItem.id = orderId;
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
            console.log('Order item dihapus:', orderId);
        }


    });

        orderItem.addEventListener('click', (e) => {
            // Jangan buka dialog jika klik tombol delete
            if (!e.target.classList.contains('delete-order-btn')) {
                tampilkanDialog(orderData.item.id, orderData.item.name, orderData.item.image, orderData.item.price);
            }
        });
        
        ordersList.appendChild(orderItem);
    }
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
                        <button class="order-btn">Order</button>
                    </div>
        <!-- Menu Grid -->
                    <div class="menu-grid" id="menu-grid"> 
                        @foreach ($menuItems as $item)
                        <div class="menu-item">
                            <div class="menu-image"><img src="{{ $item->image }}"></div>
                            <div class="menu-name">{{ $item->name }}</div>
                            <button class="menu-btn" onclick="tampilkanDialog({{ $item->id }}, '{{ $item->name }}', '{{ $item->image }}', {{ $item->price ?? 0 }})">Tambahkan</button> 
                        </div>  @endforeach   
                    </div>
                </div>
            </div>
        </div>
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

      <h2 class="menu-name" id="dialog-name">Dimsum isi 5</h2>
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
                    <div class="card-button">
                        <span>Pesan Sekarang</span>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">OUTLET</div>
                    <div class="card-image outlet-image"></div>
                    <div class="card-text">
                        Kunjungi kami di BANDUNG TIMUR, Jl. Pasir Impun No. 28. Lokasi strategis dan mudah dijangkau untuk menikmati dimsum favorit Anda.
                    </div>
                    <div class="card-button">
                        <span>Baca Selengkapnya</span>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">GALERI</div>
                    <div class="card-image gallery-image"></div>
                    <div class="card-text">
                        Lihat berbagai foto produk dan momen spesial kami. Dari proses pembuatan hingga penyajian dimsum yang menggugah selera.
                    </div>
                    <div class="card-button">
                        <span>Baca Selengkapnya</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <h3>Footer</h3>
            <div class="footer-bottom">
                <div class="copyright">Copyright 2025. All rights reserved.</div>
                <div class="footer-strip"></div>
            </div>
        </div>
    </div>
</body>


</html> 