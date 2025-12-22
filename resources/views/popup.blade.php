<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Delivery</title>

    <!-- CSS TERPISAH -->
    <link rel="stylesheet" href="{{ asset('style5.css') }}">
</head>
<body>

<div class="overlay">
    <div class="modal">
        <h2>Isi Datadiri</h2>

        <form action="{{ route('pesan.kirim') }}" method="POST">
            @csrf

            <label>Nama Lengkap</label>
            <input type="text" name="nama" required>

            <label>No Telepon</label>
            <input type="text" name="telepon" required>

            <label>Alamat Lengkap</label>
            <textarea name="alamat" rows="3" required></textarea>

            <div class="btn-wrapper">
                <button type="submit" class="btn-kirim">Pesan</button>
                <a href="/" class="btn-batal">Batal</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
