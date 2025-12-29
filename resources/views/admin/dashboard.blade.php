@extends('layout.laydsb')
@section('content')
<div class="bd-kartu-grid">
    <!-- Pendapatan Kemarin -->
    <div class="bd-kartu-stat">
        <div class="bd-kartu-stat__header">
            <div class="bd-kartu-stat__ikon"><img src="img/mny.png" alt=""></div>
            <div class="bd-kartu-stat__perubahan {{ $perubahanPendapatan >= 0 ? 'bd-kartu-stat__perubahan--positif' : 'bd-kartu-stat__perubahan--negatif' }}">
                {{ $perubahanPendapatan >= 0 ? '↑' : '↓' }} {{ abs(round($perubahanPendapatan, 1)) }}%
            </div>
        </div>
        <div class="bd-kartu-stat__label">Pendapatan Kemarin</div>
        <div class="bd-kartu-stat__nilai">IDR {{ number_format($pendapatanKemarin, 0, ',', '.') }}</div>
    </div>

    <!-- Pendapatan Hari Ini -->
    <div class="bd-kartu-stat">
        <div class="bd-kartu-stat__header">
            <div class="bd-kartu-stat__ikon"><img src="img/mny.png" alt=""></div>
            <div class="bd-kartu-stat__perubahan {{ $perubahanPesanan >= 0 ? 'bd-kartu-stat__perubahan--positif' : 'bd-kartu-stat__perubahan--negatif' }}">
                {{ $perubahanPesanan >= 0 ? '↑' : '↓' }} {{ abs(round($perubahanPesanan, 1)) }}%
            </div>
        </div>
        <div class="bd-kartu-stat__label">Pendapatan Hari Ini</div>
        <div class="bd-kartu-stat__nilai">IDR {{ number_format($pendapatanHariIni, 0, ',', '.') }}</div>
    </div>
</div>

<!-- CHART STATUS PESANAN -->
<div class="bd-bagan">
    <div class="bd-bagan__judul">Status Pesanan</div>
    <div class="bd-bagan__wadah">
        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
            <div class="bd-batang" style="height: {{ $chartStatusHeights['pending'] }}px; background-color: #ffc107;"></div>
            <span class="bd-batang__label">Pending ({{ $statusPending }})</span>
        </div>
        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
            <div class="bd-batang" style="height: {{ $chartStatusHeights['dikonfirmasi'] }}px; background-color: #17a2b8;"></div>
            <span class="bd-batang__label">Konfirmasi ({{ $statusDikonfirmasi }})</span>
        </div>
        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
            <div class="bd-batang" style="height: {{ $chartStatusHeights['diantar'] }}px; background-color: #007bff;"></div>
            <span class="bd-batang__label">Diantar ({{ $statusDiantar }})</span>
        </div>
        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
            <div class="bd-batang" style="height: {{ $chartStatusHeights['selesai'] }}px; background-color: #28a745;"></div>
            <span class="bd-batang__label">Selesai ({{ $statusSelesai }})</span>
        </div>
    </div>
</div>

<!-- BOTTOM STATS -->
<div class="bd-grid-bawah">
    <div class="bd-kartu-info">
        <div class="bd-kartu-info__label">Total Pelanggan</div>
        <div class="bd-kartu-info__angka">{{ $totalPelanggan }}</div>
    </div>
    <div class="bd-kartu-info">
        <div class="bd-kartu-info__label">Total Menu</div>
        <div class="bd-kartu-info__angka">{{ $totalMenu }}</div>
    </div>
    <div class="bd-kartu-info">
        <div class="bd-kartu-info__label">Pesanan Bulan Ini</div>
        <div class="bd-kartu-info__angka" style="color: var(--warna-biru);">{{ $totalPesananBulanIni }}</div>
        <div class="bd-kartu-info__persentase">Total: IDR {{ number_format($pendapatanBulanan, 0, ',', '.') }}</div>
    </div>
</div>

<!-- TABLE PESANAN TERBARU -->
<div class="bd-tabel-wrapper">
    <div class="bd-tabel-wrapper__judul">Pesanan Terbaru</div>
    <table class="bd-tabel">
        <thead>
            <tr>
                <th class="bd-tabel__header" style="width: 25%;">Nama Pelanggan</th>
                <th class="bd-tabel__header" style="width: 20%;">Menu</th>
                <th class="bd-tabel__header" style="width: 15%;">Status</th>
                <th class="bd-tabel__header" style="width: 20%;">Waktu</th>
                <th class="bd-tabel__header" style="width: 20%;">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pesananTerbaru as $p)
            <tr class="bd-tabel__baris">
                <td class="bd-tabel__data">{{ $p->pelanggan->nama ?? 'N/A' }}</td>
                <td class="bd-tabel__data">{{ $p->menu->nama_menu ?? 'N/A' }}</td>
                <td class="bd-tabel__data">
                    <span class="bd-status {{ 
                        $p->status_pesanan == 'pending' ? 'bd-status--pending' : 
                        ($p->status_pesanan == 'selesai' ? 'bd-status--selesai' : 
                        ($p->status_pesanan == 'diantar' ? 'bd-status--diantar' : 'bd-status--dikonfirmasi')) 
                    }}">
                        {{ ucfirst(str_replace('_', ' ', $p->status_pesanan)) }}
                    </span>
                </td>
                <td class="bd-tabel__data">{{ $p->created_at->format('H:i') }}</td>
                <td class="bd-tabel__data">IDR {{ number_format($p->total_harga, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr class="bd-tabel__baris">
                <td colspan="5" class="bd-tabel__data" style="text-align: center;">Tidak ada pesanan terbaru</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- TABLE KRITIK DAN SARAN -->
<div class="bd-tabel-wrapper">
    <div class="bd-tabel-wrapper__judul">Kritik dan Saran</div>
    <table class="bd-tabel">
        <thead>
            <tr>
                <th class="bd-tabel__header" style="width: 20%;">Nama</th>
                <th class="bd-tabel__header" style="width: 20%;">No Telepon</th>
                <th class="bd-tabel__header" style="width: 40%;">Saran</th>
                <th class="bd-tabel__header" style="width: 20%;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($saran as $s)
            <tr class="bd-tabel__baris">
                <td class="bd-tabel__data">{{ $s->nama }}</td>
                <td class="bd-tabel__data">{{ $s->no_tlp }}</td>
                <td class="bd-tabel__data">{{ $s->isi_saran }}</td>
                <td class="bd-tabel__data">{{ $s->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr class="bd-tabel__baris">
                <td colspan="4" class="bd-tabel__data" style="text-align: center;">Belum ada saran masuk</td>
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
    
    .bd-status--dikonfirmasi {
        background-color: #17a2b8;
        color: white;
    }
    
    .bd-status--diantar {
        background-color: #007bff;
        color: white;
    }
    
    .bd-status--selesai {
        background-color: #28a745;
        color: white;
    }
</style>

@endsection