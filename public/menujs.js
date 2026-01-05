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

function keForm() {
    const orders = ambilSemuaPesanan();
    
    console.log('keForm called, orders:', orders);
    
    // Validasi: cek apakah ada pesanan
    if (orders.length === 0) {
        alert('Belum ada pesanan yang ditambahkan!');
        return;
    }
    
    // Ambil total harga
    const totalHargaText = document.getElementById('total-harga').textContent;
    const totalHarga = parseInt(totalHargaText.replace(/[^0-9]/g, ''));
    
    console.log('Total harga:', totalHarga);
    
    // Tampilkan ringkasan pesanan di modal
    const orderListHtml = orders.map(order => `
        <div class="order-item-summary">
            ${order.nama_menu} (${order.type}) - ${order.quantity}x - Rp ${formatRupiah(order.subtotal)}
            ${order.notes ? `<div style="font-size: 12px; color: #666; margin-top: 4px; font-style: italic;">📝 Catatan: ${order.notes}</div>` : ''}
        </div>
    `).join('');
    
    document.getElementById('checkout-order-list').innerHTML = orderListHtml;
    document.getElementById('checkout-total').textContent = 'Total: Rp ' + formatRupiah(totalHarga);
    
    // Simpan data ke hidden input
    document.getElementById('orders-data').value = JSON.stringify(orders);
    document.getElementById('total-harga-input').value = totalHarga;
    
    console.log('Orders data set:', JSON.stringify(orders));
    
    // Buka modal
    const modal = document.getElementById('checkout-modal');
    console.log('Opening modal:', modal);
    modal.showModal();
}

// Fungsi untuk menutup modal checkout
function tutupCheckout() {
    document.getElementById('checkout-modal').close();
    document.getElementById('checkout-form').reset();
}

// Handle form submit
document.getElementById('checkout-form').addEventListener('submit', function(e) {
    console.log('Form submit triggered');
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

function closePopupPembayaran() {
    const popup = document.getElementById('popup-pembayaran');
    if (popup) popup.style.display = 'none';
}

// Alias untuk updateTotalHarga
function hitungTotalPesanan() {
    updateTotalHarga();
}