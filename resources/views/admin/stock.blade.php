@extends('layout.laydsb')
@section('content')

<div class="bd-tabel-wrapper">
    <div class="bd-tabel-wrapper__judul">Update Stock</div>
    
    <div style="margin-bottom: 15px;">
        <a href="/admin/buat_menu" class="bd-tambah" style="padding: 10px 20px; background-color: #28a745; color: white; border-radius: 4px; text-decoration: none; display: inline-block;">+ Tambah Menu</a>
    </div>

    @if ($message = Session::get('success'))
        <div style="padding: 12px; margin-bottom: 15px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px;">
            {{ $message }}
        </div>
    @endif

    <table class="bd-tabel">
        <thead>
            <tr>
                <th class="bd-tabel__header" style="width: 15%;">Nama Menu</th>
                <th class="bd-tabel__header" style="width: 12%;">Harga Reguler</th>
                <th class="bd-tabel__header" style="width: 12%;">Harga Mini</th>
                <th class="bd-tabel__header" style="width: 12%;">Kategori</th>
                <th class="bd-tabel__header" style="width: 8%;">Stock</th>
                <th class="bd-tabel__header" style="width: 15%;">Foto</th>
                <th class="bd-tabel__header" style="width: 16%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($menu as $m)
            <tr class="bd-tabel__baris">
                <td class="bd-tabel__data">{{ $m->nama_menu }}</td>
                <td class="bd-tabel__data">Rp {{ number_format($m->harga_reguler, 0, ',', '.') }}</td>
                <td class="bd-tabel__data">Rp {{ number_format($m->harga_mini, 0, ',', '.') }}</td>
                <td class="bd-tabel__data">{{ $m->kategori }}</td>
                <td class="bd-tabel__data"><span style="background-color: #007bff; color: white; padding: 4px 8px; border-radius: 3px;">{{ $m->stock }}</span></td>
                <td class="bd-tabel__data">
                    <img src="{{ asset('storage/' . $m->foto_menu) }}" alt="{{ $m->nama_menu }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
                </td>
                <td class="bd-tabel__data">
                    <div style="display: flex; gap: 5px;">
                        <a href="/admin/stock/{{ $m->id }}/edit" style="padding: 6px 12px; background-color: #ffc107; color: white; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; font-size: 12px; font-weight: bold;">
                             Edit
                        </a>
                        <form action="/stock/{{ $m->id }}" method="POST" style="display: inline; margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus" style="padding: 6px 12px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 12px; font-weight: bold;" onclick="return confirm('Yakin ingin menghapus menu ini?')">
                                 Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr class="bd-tabel__baris">
                <td colspan="6" class="bd-tabel__data" style="text-align: center; color: #999;">
                    Tidak ada menu
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<style>
    .btn-hapus:hover {
        background-color: #c82333 !important;
    }
    
    a[href*="/edit"]:hover {
        background-color: #ffb300 !important;
    }
</style>

@endsection
