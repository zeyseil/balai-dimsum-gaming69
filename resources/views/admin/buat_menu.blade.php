@extends('layout.laydsb')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <form action="/stock" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama_menu" class="form-label">Nama menu</label>
            <input type="text" class="form-control" id="nama_menu" name="nama_menu"  required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">stock</label>
            <textarea class="form-control" id="stock" name="stock" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">kategori menu</label>
            {{-- <textarea class="form-control" id="kategori" name="kategori" rows="3"></textarea> --}}
            <select class="form-control"  name="kategori" id="kategori">
                <option value="reguler">reguler</option>
                <option value="mini">mini</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="harga_reguler" class="form-label">Harga Reguler</label>
            <input type="number" step="0.01" class="form-control" id="harga_reguler" name="harga_reguler" value="masukan harga reguler" required>
        </div>
        <div class="mb-3">
            <label for="harga_mini" class="form-label">Harga Mini</label>
            <input type="number" step="0.01" class="form-control" id="harga_mini" name="harga_mini" value="masukan harga mini" required>
        </div>
            <div class="mb-3">
            <label for="foto_menu" class="form-label">Foto Menu</label>
            <input type="file" class="form-control" id="foto_menu" name="foto_menu" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Produk</button>
        <a href="/admin" class="btn btn-secondary">Batal</a>
    </form>
</body>
</html>
@endsection