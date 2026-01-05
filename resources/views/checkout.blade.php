<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran | Balai Dimsum</title>
    <link rel="stylesheet" href="{{ asset('payment.css') }}">
</head>
<body>

<div class="container">
    <h1>Pembayaran</h1>

    <form 
        action="{{ route('pembayaran.store') }}"
        method="POST" 
        enctype="multipart/form-data">

        @csrf

        <input type="hidden" name="pesanan_id" value="{{ $pesanan_id }}">

        <!-- Ringkasan Pesanan -->
        <div class="card">
            <h2>Ringkasan Pesanan</h2>
            @if(isset($detailPesanan) && count($detailPesanan) > 0)
                @foreach($detailPesanan as $detail)
                    <div class="row">
                        <span>{{ $detail->menu->nama_menu }} ({{ $detail->jumlah_pesanan }}x)</span>
                        <span>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                    </div>
                    @if($detail->catatan)
                        <div style="font-size: 13px; color: #e6e6e6; margin-left: 10px; margin-top: -1%; margin-bottom: 10px; font-style: italic;">
                            Catatan: {{ $detail->catatan }}
                        </div>
                    @endif
                @endforeach
                <hr>
                <div class="row total">
                    <span>Total</span>
                    <span>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                </div>
            @else
                <div class="row">
                    <span>Tidak ada detail pesanan</span>
                </div>
            @endif
        </div>

        <!-- Metode Pembayaran -->
        <div class="card">
            <h2>Metode Pembayaran</h2>

            <label class="payment-option">
                <input type="radio" name="payment_method" value="bca" required>
                Transfer Bank (BCA)
            </label>

            <label class="payment-option">
                <input type="radio" name="payment_method" value="ewallet">
                GoPay / DANA
            </label>
        </div>

        <!-- Instruksi -->
        <div class="card">
            <h2>Instruksi Pembayaran</h2>
            <p>Silakan transfer sesuai total pembayaran ke:</p>
            <strong>BCA 123456789 a/n Balai Dimsum</strong>
        </div>

        <!-- Upload Bukti -->
        <div class="card">
            <h2>Upload Bukti Pembayaran</h2>

            <label class="upload-box">
                <input type="file" name="bukti_pembayaran" accept="image/*" required>
                <span>Klik untuk upload bukti transfer</span>
                <small>Format: JPG / PNG</small>
            </label>
        </div>

        <!-- Tombol -->
        <button type="submit" class="btn-primary">
            Saya Sudah Bayar
        </button>

    </form>
</div>

</body>
</html>
