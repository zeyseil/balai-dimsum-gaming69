@extends('layout.laydsb')
@section('content')
<div class="bd-tabel-wrapper">
    <div class="bd-tabel-wrapper__judul">Pesanan</div>
    
    <!-- Search dan Filter Section -->
    <div style="margin-bottom: 20px; padding: 15px; background-color: #f5f5f5; border-radius: 5px;">
        <form method="GET" action="{{ route('admin.pesanan') }}" style="display: flex; gap: 10px; flex-wrap: wrap;">
            <input type="text" name="search" placeholder="Cari nama, alamat, atau menu..." 
                   value="{{ $searchQuery }}" style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; flex: 1; min-width: 200px;">
            
            <select name="status" style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
                <option value="">Semua Status</option>
                <option value="pending" {{ $statusFilter == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="dikonfirmasi" {{ $statusFilter == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                <option value="diantar" {{ $statusFilter == 'diantar' ? 'selected' : '' }}>Diantar</option>
                <option value="sampai_tujuan" {{ $statusFilter == 'sampai_tujuan' ? 'selected' : '' }}>Sampai Tujuan</option>
                <option value="selesai" {{ $statusFilter == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            
            <button type="submit" style="padding: 8px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
                Cari
            </button>
            
            <a href="{{ route('admin.pesanan') }}" style="padding: 8px 20px; background-color: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block;">
                Reset
            </a>
        </form>
    </div>

    <!-- Success/Error Messages -->
    @if ($message = Session::get('success'))
        <div style="padding: 12px; margin-bottom: 15px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px;">
            {{ $message }}
        </div>
    @endif
    
    @if ($message = Session::get('error'))
        <div style="padding: 12px; margin-bottom: 15px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px;">
            {{ $message }}
        </div>
    @endif

    <table class="bd-tabel">
        <thead>
            <tr>
                <th class="bd-tabel__header" style="width: 15%;">Nama</th>
                <th class="bd-tabel__header" style="width: 20%;">Alamat</th>
                <th class="bd-tabel__header" style="width: 15%;">Menu</th>
                <th class="bd-tabel__header" style="width: 12%;">Status Pembayaran</th>
                <th class="bd-tabel__header" style="width: 12%;">Status Pesanan</th>
                <th class="bd-tabel__header" style="width: 15%;">Tanggal Pembelian</th>
                <th class="bd-tabel__header" style="width: 11%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($detail_pesanan as $p)
            @if($p->pesanan)
            <tr class="bd-tabel__baris">
                <td class="bd-tabel__data">{{ $p->pesanan->pelanggan->nama }}</td>
                <td class="bd-tabel__data">{{ $p->pesanan->pelanggan->alamat }}</td>
                <td class="bd-tabel__data">{{ $p->pesanan->menu->nama_menu }}</td>
                <td class="bd-tabel__data"><span class="bd-status bd-status--diantar">Dibayar</span></td>
                <td class="bd-tabel__data">
                    <span class="bd-status {{ $p->pesanan->status_pesanan == 'pending' ? 'bd-status--pending' : ($p->pesanan->status_pesanan == 'selesai' ? 'bd-status--selesai' : 'bd-status--diantar') }}">
                        {{ ucfirst(str_replace('_', ' ', $p->pesanan->status_pesanan)) }}
                    </span>
                </td>
                <td class="bd-tabel__data">{{ $p->pesanan->created_at->format('d/m/Y H:i') }}</td>
                <td class="bd-tabel__data">
                    @if($p->pesanan->status_pesanan !== 'selesai')
                        <form action="{{ route('pesanan.updateStatus', $p->pesanan->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-aksi" style="padding: 6px 12px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                @if($p->pesanan->status_pesanan == 'pending')
                                    Konfirmasi
                                @elseif($p->pesanan->status_pesanan == 'dikonfirmasi')
                                    Kirim
                                @elseif($p->pesanan->status_pesanan == 'diantar')
                                    Sampai
                                @elseif($p->pesanan->status_pesanan == 'sampai_tujuan')
                                    Selesai
                                @endif
                            </button>
                        </form>
                    @else
                        <span style="padding: 6px 12px; background-color: #6c757d; color: white; border-radius: 4px; font-size: 12px;">
                            Pesanan Selesai
                        </span>
                    @endif
                </td>
            </tr>
            @endif
            @empty
            <tr class="bd-tabel__baris">
                <td colspan="7" class="bd-tabel__data" style="text-align: center;">Tidak ada data pesanan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<style>
    .bd-status--pending {
        background-color: #ffc107;
        color: #333;
    }
    
    .bd-status--selesai {
        background-color: #28a745;
        color: white;
    }
    
    .bd-status--diantar {
        background-color: #17a2b8;
        color: white;
    }
</style>

@endsection