

    <link rel="stylesheet" href="{{ asset('style5.css') }}">
<div class="overlay">
    <div class="modal">
        <h2>Isi Datadiri</h2>

<form action="{{ route('pesan.kirim') }}" method="POST">
    @csrf

    <label>Nama</label>
    <input type="text" name="nama" maxlength="50" required>

    <label>No Telepon</label>
    <input type="text" name="no_telepon" maxlength="15" required>

    <label>Alamat</label>
    <textarea name="alamat" maxlength="100" required></textarea>

    <button type="submit">Kirim</button>
</form>

    </div>
</div>