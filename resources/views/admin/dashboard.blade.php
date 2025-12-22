                
@extends('layout.laydsb')
@section('content')
<div class="bd-kartu-grid">
                    <div class="bd-kartu-stat">
                        <div class="bd-kartu-stat__header">
                            <div class="bd-kartu-stat__ikon"><img src="img/mny.png"" alt=""></div>
                            <div class="bd-kartu-stat__perubahan bd-kartu-stat__perubahan--positif">↑ 40%</div>
                        </div>
                        <div class="bd-kartu-stat__label">Pendapatan Kemarin</div>
                        <div class="bd-kartu-stat__nilai">IDR. 500.000</div>
                    </div>

                    <div class="bd-kartu-stat">
                        <div class="bd-kartu-stat__header">
                            <div class="bd-kartu-stat__ikon"><img src="img/mny.png"" alt=""></div>
                            <div class="bd-kartu-stat__perubahan bd-kartu-stat__perubahan--negatif">↓ 20%</div>
                        </div>
                        <div class="bd-kartu-stat__label">Pendapatan Hari Ini</div>
                        <div class="bd-kartu-stat__nilai">IDR. 100.000</div>
                    </div>
                </div>

                <!-- CHART -->
                <div class="bd-bagan">
                    <div class="bd-bagan__judul">Penjualan Bulanan</div>
                    <div class="bd-bagan__wadah">
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div class="bd-batang" style="height: 100px;"></div>
                            <span class="bd-batang__label">Jan</span>
                        </div>
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div class="bd-batang" style="height: 233px;"></div>
                            <span class="bd-batang__label">Feb</span>
                        </div>
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div class="bd-batang" style="height: 133px;"></div>
                            <span class="bd-batang__label">Mar</span>
                        </div>
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div class="bd-batang" style="height: 200px;"></div>
                            <span class="bd-batang__label">Apr</span>
                        </div>
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div class="bd-batang" style="height: 113px;"></div>
                            <span class="bd-batang__label">May</span>
                        </div>
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div class="bd-batang" style="height: 120px;"></div>
                            <span class="bd-batang__label">Jun</span>
                        </div>
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div class="bd-batang" style="height: 187px;"></div>
                            <span class="bd-batang__label">Jul</span>
                        </div>
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div class="bd-batang" style="height: 73px;"></div>
                            <span class="bd-batang__label">Aug</span>
                        </div>
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div class="bd-batang" style="height: 127px;"></div>
                            <span class="bd-batang__label">Sep</span>
                        </div>
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div class="bd-batang" style="height: 253px;"></div>
                            <span class="bd-batang__label">Oct</span>
                        </div>
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div class="bd-batang" style="height: 187px;"></div>
                            <span class="bd-batang__label">Nov</span>
                        </div>
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div class="bd-batang" style="height: 67px;"></div>
                            <span class="bd-batang__label">Dec</span>
                        </div>
                    </div>
                </div>

                <!-- BOTTOM STATS -->
                <div class="bd-grid-bawah">
                    <div class="bd-kartu-info">
                        <div class="bd-kartu-info__label">Dimsum</div>
                        <div class="bd-kartu-info__angka">90 qty</div>
                    </div>
                    <div class="bd-kartu-info">
                        <div class="bd-kartu-info__label">Saus Mentai</div>
                        <div class="bd-kartu-info__angka">1 kg</div>
                    </div>
                    <div class="bd-kartu-info">
                        <div class="bd-kartu-info__label">Pendapat Bulanan</div>
                        <div class="bd-kartu-info__angka" style="color: var(--warna-biru);">IDR. 5M</div>
                        <div class="bd-kartu-info__persentase">↑ 10%</div>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="bd-tabel-wrapper">
                    <div class="bd-tabel-wrapper__judul">Kilas Pesanan</div>
                    <table class="bd-tabel">
                        <thead>
                            <tr>
                                <th class="bd-tabel__header" style="width: 35%;">Nama</th>
                                <th class="bd-tabel__header" style="width: 25%;">Menu</th>
                                <th class="bd-tabel__header" style="width: 25%;">Status</th>
                                <th class="bd-tabel__header" style="width: 15%;">Waktu</th>
                            </tr>
                        </thead>
                        <tbodyA>
                            <tr class="bd-tabel__baris">
                                <td class="bd-tabel__data">Asep knalpot</td>
                                <td class="bd-tabel__data">NS4</td>
                                <td class="bd-tabel__data"><span class="bd-status bd-status--diantar">Diantar</span></td>
                                <td class="bd-tabel__data">14:30</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
               <div class="bd-tabel-wrapper">
                    <div class="bd-tabel-wrapper__judul">Kritik dan Saran</div>
                    <table class="bd-tabel">
                        <thead>
                            <tr>
                                <th class="bd-tabel__header" style="width: 35%;">Nama</th>
                                <th class="bd-tabel__header" style="width: 25%;">No telepon</th>
                                <th class="bd-tabel__header" style="width: 25%;">Saran</th>
                                <th class="bd-tabel__header" style="width: 25%;">Tanggal</th>

                            </tr>
                        </thead>
                        <tbodyA>
                            <tr class="bd-tabel__baris">
                                @foreach ($saran as $s )
                                    
                                <td class="bd-tabel__data">{{ $s->nama }}</td>
                                <td class="bd-tabel__data">{{ $s->no_tlp }}</td>
                                <td class="bd-tabel__data">{{ $s->isi_saran }}</td>
                                <td class="bd-tabel__data">{{ $s->created_at }}</td>
                            </tr>
                             @endforeach
                        </tbody>
                    </table>
                </div>

@endsection