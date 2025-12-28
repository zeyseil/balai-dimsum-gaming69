<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran | Balai Dimsum</title>
    <link rel="stylesheet" href='payment.css'>
</head>
<body>

<div class="container">
    <h1>Pembayaran</h1>

    <!-- Ringkasan Pesanan -->
    <div class="card">
        <h2>Ringkasan Pesanan</h2>

        <div class="row">
            <span>Dimsum Ayam (2x)</span>
            <span>Rp 40.000</span>
        </div>

        <div class="row">
            <span>Dimsum Udang (1x)</span>
            <span>Rp 25.000</span>
        </div>

        <hr>

        <div class="row total">
            <span>Total</span>
            <span>Rp 65.000</span>
        </div>
    </div>

    <!-- Metode Pembayaran -->
    <div class="card">
        <h2>Metode Pembayaran</h2>

        <label class="payment-option">
            <input type="radio" name="payment">
            Transfer Bank (BCA)
        </label>

        <label class="payment-option">
            <input type="radio" name="payment">
            GoPay / DANA
        </label>
    </div>

    <!-- Instruksi -->
    <div class="card">
        <h2>Instruksi Pembayaran</h2>
        <p>Silakan transfer sesuai total pembayaran ke:</p>
        <strong>BCA 123456789 a/n Balai Dimsum</strong>
    </div>

<!-- Upload Bukti Pembayaran -->
<div class="card">
    <h2>Upload Bukti Pembayaran</h2>

    <label class="upload-box">
        <input type="file" accept="image/*">
        <span>Klik untuk upload bukti transfer</span>
        <small>Format: JPG / PNG</small>
    </label>
</div>

    <!-- Tombol -->
    <button class="btn-primary">Saya Sudah Bayar</button>
</div>

</body>
</html>
