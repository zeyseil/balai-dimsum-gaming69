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
                <td class="bd-tabel__data">
                    <span class="bd-status {{ $p->pesanan->pembayaran && $p->pesanan->pembayaran->status_pembayaran == 'dibayar' ? 'bd-status--selesai' : 'bd-status--diantar' }}">
                        {{ $p->pesanan->pembayaran && $p->pesanan->pembayaran->status_pembayaran == 'dibayar' ? 'Dibayar' : 'Dikonfirmasi' }}
                    </span>
                    @if($p->pesanan->pembayaran && $p->pesanan->pembayaran->bukti_pembayaran)
                    <button onclick="showBuktiModal('{{ asset('storage/' . $p->pesanan->pembayaran->bukti_pembayaran) }}', '{{ $p->pesanan->pembayaran->id }}')" style="margin-left: 5px; padding: 4px 8px; background-color: #0066cc; color: white; border: none; border-radius: 3px; cursor: pointer; font-size: 11px;">
                        👁️ View
                    </button>
                    @endif
                </td>
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

    /* Modal Styles */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content {
        background: white;
        padding: 30px;
        border-radius: 10px;
        max-width: 600px;
        width: 90%;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 15px;
    }

    .modal-header h2 {
        margin: 0;
        color: #333;
        font-size: 20px;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 28px;
        cursor: pointer;
        color: #999;
    }

    .modal-close:hover {
        color: #333;
    }

    .modal-body {
        margin-bottom: 20px;
    }

    .bukti-image {
        width: 100%;
        max-height: 400px;
        object-fit: contain;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .modal-footer {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .btn-confirm {
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
    }

    .btn-confirm:hover {
        background-color: #218838;
    }

    .btn-close {
        padding: 10px 20px;
        background-color: #6c757d;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-close:hover {
        background-color: #5a6268;
    }
</style>

<!-- Modal untuk Bukti Pembayaran -->
<div id="buktiModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2>📋 Bukti Pembayaran</h2>
            <button class="modal-close" onclick="closeBuktiModal()">✕</button>
        </div>
        <div class="modal-body">
            <img id="buktiImage" src="" alt="Bukti Pembayaran" class="bukti-image">
            <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">
                    <strong>Status Pembayaran:</strong> <span id="statusPembayaran" style="color: #28a745; font-weight: bold;">Menunggu Konfirmasi</span>
                </p>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-confirm" id="confirmBtn" onclick="confirmPembayaran()">✓ Konfirmasi Pembayaran</button>
            <button class="btn-close" onclick="closeBuktiModal()">Tutup</button>
        </div>
    </div>
</div>

<script>
    let currentPembayaranId = null;

    function showBuktiModal(imageUrl, pembayaranId) {
        currentPembayaranId = pembayaranId;
        document.getElementById('buktiImage').src = imageUrl;
        document.getElementById('buktiModal').classList.add('active');
    }

    function closeBuktiModal() {
        document.getElementById('buktiModal').classList.remove('active');
        currentPembayaranId = null;
    }

    function confirmPembayaran() {
        if (!currentPembayaranId) {
            alert('ID Pembayaran tidak ditemukan');
            return;
        }

        if (confirm('Apakah Anda yakin ingin mengkonfirmasi pembayaran ini?')) {
            // Submit form untuk confirm pembayaran
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ url("/pembayaran") }}/' + currentPembayaranId + '/confirm';
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (csrfToken) {
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);
            }

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PATCH';
            form.appendChild(methodInput);

            document.body.appendChild(form);
            form.submit();
        }
    }

    // Close modal saat klik di luar
    document.getElementById('buktiModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeBuktiModal();
        }
    });
</script>

@endsection