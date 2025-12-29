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
    <form action="{{ route('stock.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_menu" class="form-label">Nama menu</label>
            <input type="text" class="form-control" id="nama_menu" name="nama_menu" value="{{ $menu->nama_menu }}"  required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">stock</label>
            <textarea class="form-control" id="stock" name="stock" rows="3">{{ $menu->stock }}</textarea>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">kategori menu</label>
            <select class="form-control"  name="kategori" id="kategori">
                <option value="{{ $menu->kategori }}"> {{ $menu->kategori }}></option>
                <option value="reguler">reguler </option>
                <option value="mini">mini</option>
            </select>
            {{-- <textarea class="form-control" id="kategori" name="kategori" rows="3" value="{{ $menu->kategori }}"> {{ $menu->kategori }}</textarea> --}}
        </div>
        {{-- <div class="mb-3">
            <label for="harga_menu" class="form-label">Harga</label>
            <input type="number" step="0.01" class="form-control" id="harga_menu" name="harga_menu" value="{{ $menu->harga_menu }}" >
        </div> --}}
        <div class="mb-3">
            <label for="harga_reguler" class="form-label">Harga Reguler</label>
            <input type="number" step="0.01" class="form-control" id="harga_reguler" name="harga_reguler" value="{{ $menu->harga_reguler }}" required>
        </div>
        <div class="mb-3">
            <label for="harga_mini" class="form-label">Harga Mini</label>
            <input type="number" step="0.01" class="form-control" id="harga_mini" name="harga_mini" value="{{ $menu->harga_mini }}" required>
        </div>
            <div class="mb-3">
            <label for="foto_menu" class="form-label">Foto Menu</label>
            @if ($menu ->foto_menu)
            <img src="{{ asset('storage/' . $menu->foto_menu) }}" alt="{{ $menu->foto_menu }}" width="100">
            @endif
            <input type="file" class="form-control" id="foto_menu" name="foto_menu" valie="{{ $menu->foto_menu }}" >
        </div>
        <button type="submit" class="btn btn-success">Simpan Produk</button>
        <a href="/stock" class="btn btn-secondary">Batal</a>
    </form>
</body>
</html>
@endsection
