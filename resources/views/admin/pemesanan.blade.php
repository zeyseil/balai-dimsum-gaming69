@extends('layout.laydsb')
@section('content')
<div class="bd-tabel-wrapper">
                    <div class="bd-tabel-wrapper__judul">Pesanan</div>
                    <table class="bd-tabel">
                        <thead>
                            <tr>
                                <th class="bd-tabel__header" style="width: 25%;">Nama</th>
                                 <th class="bd-tabel__header" style="width: 25%;">Alamat</th>
                                <th class="bd-tabel__header" style="width: 25%;">Menu</th>
                                <th class="bd-tabel__header" style="width: 25%;">Status Pembayaran</th>
                                <th class="bd-tabel__header" style="width: 15%;">Status</th>
                                <th class="bd-tabel__header" style="width: 15%;">aksi</th>
                            </tr>
                        </thead>
                        <tbodyA>
                            <tr class="bd-tabel__baris">
                                <td class="bd-tabel__data">Asep knalpot</td>
                                <td class="bd-tabel__data">jalan Lorem ipsum dolor sit, amet consectetur adipisicing elit. Incidunt rerum, nam error enim distinctio tenetur libero commodi ipsa minima modi in doloribus quas sit beatae quis magni voluptates nobis, nisi similique totam cum dicta perspiciatis? Omnis facilis quas voluptates consectetur quia. Minus repellendus beatae sit. Harum illum ab asperiores aperiam deserunt minus culpa vel saepe deleniti magni id, nihil, obcaecati voluptates, molestiae atque laboriosam autem! Quibusdam in impedit rem veritatis nobis quis, exercitationem cum ad perspiciatis labore tempora quaerat vero ullam corporis optio earum fugiat! Libero illo ipsam maxime facilis nisi sunt. Neque earum omnis sequi magnam dolorem aliquid obcaecati!</td>
                                <td class="bd-tabel__data">NS4</td>
                                 <td class="bd-tabel__data"><span class="bd-status bd-status--diantar">Dibayar</span></td>
                                <td class="bd-tabel__data"><span class="bd-status bd-status--dianta r">Diantar</span></td>
                                <td class="bd-tabel__data"><span class="bd-status bd-status--diantar">Konfirmasi</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

@endsection