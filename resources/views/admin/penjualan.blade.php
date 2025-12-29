@extends('layout.laydsb')
@section('content')
    <div class="bd-kartu-grid">
                    <div class="bd-kartu-stat">
                        <div class="bd-kartu-stat__header">
                            <div class="bd-kartu-stat__ikon"><img src="img/mny.png"" alt=""></div>
                            <div class="bd-kartu-stat__perubahan {{ $pendapatanKemarin >= $pendapatanHariIni ? 'bd-kartu-stat__perubahan--positif' : 'bd-kartu-stat__perubahan--negatif' }}">{{ $pendapatanKemarin >= $pendapatanHariIni ? '↑' : '↓' }} {{ abs(round($perubahan, 1)) }}%</div>
                        </div>
                        <div class="bd-kartu-stat__label">Pendapatan Kemarin</div>
                        <div class="bd-kartu-stat__nilai">IDR. {{ number_format($pendapatanKemarin, 0, ',', '.') }}</div>
                    </div>

                    <div class="bd-kartu-stat">
                        <div class="bd-kartu-stat__header">
                            <div class="bd-kartu-stat__ikon"><img src="img/mny.png"" alt=""></div>
                            <div class="bd-kartu-stat__perubahan {{ $pendapatanHariIni >= $pendapatanKemarin ? 'bd-kartu-stat__perubahan--positif' : 'bd-kartu-stat__perubahan--negatif' }}">{{ $pendapatanHariIni >= $pendapatanKemarin ? '↑' : '↓' }} {{ abs(round($perubahan, 1)) }}%</div>
                        </div>
                        <div class="bd-kartu-stat__label">Pendapatan Hari Ini</div>
                        <div class="bd-kartu-stat__nilai">IDR. {{ number_format($pendapatanHariIni, 0, ',', '.') }}</div>
                    </div>
                </div>

                <!-- CHART -->
                <div class="bd-bagan">
                    <div class="bd-bagan__judul">Penjualan Bulanan</div>
                    <div class="bd-bagan__wadah">
                        @php
                            $bulanNama = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                        @endphp
                        @foreach($chartHeights as $key => $height)
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div class="bd-batang" style="height: {{ $height }}px;"></div>
                            <span class="bd-batang__label">{{ $bulanNama[$key] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- BOTTOM STATS -->
                <div class="bd-grid-bawah">
                    @forelse($menuTerlaris as $item)
                    <div class="bd-kartu-info">
                        <div class="bd-kartu-info__label">{{ $item->menu->nama_menu ?? 'N/A' }}</div>
                        <div class="bd-kartu-info__angka">{{ $item->total_penjualan }} qty</div>
                    </div>
                    @empty
                    <div class="bd-kartu-info">
                        <div class="bd-kartu-info__label">Belum Ada Penjualan</div>
                        <div class="bd-kartu-info__angka">0 qty</div>
                    </div>
                    @endforelse
                    <div class="bd-kartu-info">
                        <div class="bd-kartu-info__label">Pendapatan Bulanan</div>
                        <div class="bd-kartu-info__angka" style="color: var(--warna-biru);">IDR. {{ number_format($pendapatanBulanan / 1000000, 1) }}M</div>
                        <div class="bd-kartu-info__persentase">↑ {{ abs(round($perubahan, 1)) }}%</div>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="bd-tabel-wrapper">
                    <div class="bd-tabel-wrapper__judul">Kilas Pesanan</div>
                    <table class="bd-tabel">
                        <thead>
                            <tr>
                                <th class="bd-tabel__header" style="width: 35%;">Nama</th>
                                <th class="bd-tabel__header" style="width: 25%;">Total Harga</th>
                                <th class="bd-tabel__header" style="width: 25%;">Status</th>
                                <th class="bd-tabel__header" style="width: 15%;">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesananTerbaru as $pesanan)
                            <tr class="bd-tabel__baris">
                                <td class="bd-tabel__data">{{ $pesanan->pelanggan->nama ?? 'N/A' }}</td>
                                <td class="bd-tabel__data">IDR. {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                <td class="bd-tabel__data">
                                    <span class="bd-status {{ $pesanan->status_pesanan == 'pending' ? 'bd-status--pending' : ($pesanan->status_pesanan == 'confirmed' ? 'bd-status--confirmed' : 'bd-status--diantar') }}">
                                        {{ ucfirst($pesanan->status_pesanan) }}
                                    </span>
                                </td>
                                <td class="bd-tabel__data">{{ $pesanan->created_at->format('H:i') }}</td>
                            </tr>
                            @empty
                            <tr class="bd-tabel__baris">
                                <td class="bd-tabel__data" colspan="4" style="text-align: center;">Belum ada pesanan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

@endsection