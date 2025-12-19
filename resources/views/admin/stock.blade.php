@extends('layout.laydsb')
@section('content')
<div class="bd-tabel-wrapper">
                    <div class="bd-tabel-wrapper__judul">Update Stock</div>
                    <table class="bd-tabel">
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
                    <td class="bd-tabel__data"></td>
                    <td class="bd-tabel__data"></td>
                    <td class="bd-tabel__data"></td>
                    <td class="bd-tabel__data">0</td>
                    <td class="bd-tabel__data">aksi</td>
                </tr>
                    </table>
                </div>

@endsection