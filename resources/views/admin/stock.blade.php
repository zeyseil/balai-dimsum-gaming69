@extends('layout.laydsb')
@section('content')
<meta http-equiv="X-UA-Compatible" content="IE=7">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="bd-tabel-wrapper">
                    <div class="bd-tabel-wrapper__judul">Update Stock</div>
                    <table class="bd-tabel">
                        <br>
                        <thead>
                            <tr>
                                <th class="bd-tabel__header" style="width: 25%;">Nama Menu</th>
                                 <th class="bd-tabel__header" style="width: 25%;">Awal</th>
                                <th class="bd-tabel__header" style="width: 25%;">Sisa</th>
                                <th class="bd-tabel__header" style="width: 25%;">Tambah Stock</th>
                                <th class="bd-tabel__header" style="width: 15%;">aksi</th>
                            </tr>
                        </thead>
                                  
                <tr class="bd-tabel__baris">
                    @foreach ( $menu as $m )
                    <td class="bd-tabel__data">{{ $m->nama_menu }}</td>
                    <td class="bd-tabel__data">{{ $m->stock }}</td>
                    <td class="bd-tabel__data">{{ $m->stock }}</td>
                    <td class="bd-tabel__data">0</td>
                                        <td class="bd-tabel__data"> 
                        <div class="alert alert-warning">edit</div>
                    </td>
                       <td class="bd-tabel__data"> 
                        <div class="alert alert-danger">Hapus</div>
                    </td>
                    </td>
                </tr>
                 @endforeach
                    </table>
                    <div class="bd-tabel-wrapper__judul">Menu</div>
                    <div class="bd-tambah" > <a href="/admin/buat_menu">Tambah Menu</a></div>
                    <table class="bd-tabel">
                        <br>
                        <thead>
                            <tr>
                                <th class="bd-tabel__header" style="width: 25%;">Nama Menu</th>
                                 <th class="bd-tabel__header" style="width: 25%;">Harga Menu</th>
                                <th class="bd-tabel__header" style="width: 25%;">Kategori</th>
                                <th class="bd-tabel__header" style="width: 25%;">Foto Menu</th>
                                <th class="bd-tabel__header" style="width: 15%;">aksi</th>
                            </tr>
                        </thead>
                                  
                <tr class="bd-tabel__baris">
                    @foreach($menu as $m)
                    <td class="bd-tabel__data">{{ $m->nama_menu }}</td>
                    <td class="bd-tabel__data">{{ $m->harga_menu }}</td>
                    <td class="bd-tabel__data">{{ $m->kategori }}</td>
                    <td class="bd-tabel__data"><img src="{{ asset('storage/' . $m->foto_menu) }}" alt="{{ $m->foto_menu }}" width="100"></td>
                    <td class="bd-tabel__data"> 
                        <div class="alert alert-warning"> <a href="/admin/stock/{{ $m->id }}/edit">edit</a> </div>
                    </td>
                       <td class="bd-tabel__data"> 
                        <a href="/admin/stock/{id}"></a>
                            <form action="/stock/{{ $m->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="alert alert-danger">Hapus</button>
                            </form>
                    </td>
                </tr>
                @endforeach
                    </table>
                    
                </div>
@endsection