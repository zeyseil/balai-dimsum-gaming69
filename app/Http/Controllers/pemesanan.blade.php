@extends('layout.laydsb')
@section('content')
<div class="bd-tabel-wrapper">
                    <div class="bd-tabel-wrapper__judul">Pesanan</div>
                    <table class="bd-tabel">
                        <thead>
                            <tr>
                                <th class="bd-tabel__header" style="width: 25%;">Nama</th>
                                <th class="bd-tabel__header" style="width: 25%;">Alamat</th>
                                <th class="bd-tabel__header" style="width: 25%;">No Telepon</th>
                                <th class="bd-tabel__header" style="width: 25%;">Catatan</th>
                                <th class="bd-tabel__header" style="width: 25%;">Menu</th>
                                <th class="bd-tabel__header" style="width: 25%;">Status Pembayaran</th>
                                <th class="bd-tabel__header" style="width: 15%;">Status</th>
                                <th class="bd-tabel__header" style="width: 15%;">aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail_pesanan as $p)
                            <tr class="bd-tabel__baris">
                                <td class="bd-tabel__data">{{ $p['nama'] ?? '-' }}</td>
                                <td class="bd-tabel__data">{{ $p['alamat'] ?? '-' }}</td>
                                <td class="bd-tabel__data">{{ $p['no_telepon'] ?? '-' }}</td>
                                <td class="bd-tabel__data">{{ $p['catatan'] ?? '-' }}</td> 
                                <td class="bd-tabel__data">
                                    @foreach($p->detailPesanan as $detail)
                                         <div>{{ $detail->menu->nama_menu ?? '-' }} ({{ $detail->jumlah_pesanan }}x)</div>
                                     @endforeach
                                </td>
                                <td class="bd-tabel__data"><span class="bd-status bd-status--diantar">Dibayar</span></td>
                                <td class="bd-tabel__data"><span class="bd-status bd-status--diantar">Diantar</span></td>
                                <td class="bd-tabel__data"><span class="bd-status bd-status--diantar">Konfirmasi</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

@endsection