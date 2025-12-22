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
    <form action="/menu" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_menu" class="form-label">Nama menu</label>
            <input type="text" class="form-control" id="nama_menu" nama_menu="nama_menu" value="#" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3">#</textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="#" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Produk</button>
        <a href="#" class="btn btn-secondary">Batal</a>
    </form>
</body>
</html>
@endsection