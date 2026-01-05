<?php

namespace App\Http\Controllers;
Use App\models\Saran;
Use App\Models\DetailPesanan;
Use App\Models\Pesanan;
Use App\Models\Pelanggan;
Use App\Models\Menu;
Use App\Models\Pembayaran;
use Illuminate\Http\Request;

class AdminControler extends Controller
{
    public function index()
    {
        // Pendapatan kemarin
        $yesterday = now()->subDay();
        $pendapatanKemarin = Pesanan::whereDate('created_at', $yesterday->toDateString())
            ->sum('total_harga');

        // Pendapatan hari ini
        $today = now();
        $pendapatanHariIni = Pesanan::whereDate('created_at', $today->toDateString())
            ->sum('total_harga');

        // Persentase perubahan pendapatan
        $perubahanPendapatan = $pendapatanKemarin > 0 
            ? (($pendapatanHariIni - $pendapatanKemarin) / $pendapatanKemarin) * 100 
            : 0;

        // Total pesanan hari ini
        $totalPesananHariIni = Pesanan::whereDate('created_at', $today->toDateString())->count();
        
        // Total pesanan kemarin
        $totalPesananKemarin = Pesanan::whereDate('created_at', $yesterday->toDateString())->count();
        
        $perubahanPesanan = $totalPesananKemarin > 0 
            ? (($totalPesananHariIni - $totalPesananKemarin) / $totalPesananKemarin) * 100 
            : 0;

        // Data status pesanan untuk chart
        $statusPending = Pesanan::where('status_pesanan', 'pending')->count();
        $statusDikonfirmasi = Pesanan::where('status_pesanan', 'dikonfirmasi')->count();
        $statusDiantar = Pesanan::where('status_pesanan', 'diantar')->count();
        $statusSelesai = Pesanan::where('status_pesanan', 'selesai')->count();
        
        $totalPesananSemuanya = $statusPending + $statusDikonfirmasi + $statusDiantar + $statusSelesai;
        
        // Normalisasi tinggi chart untuk status pesanan (skala 0-300px)
        $statusData = [
            'pending' => $statusPending,
            'dikonfirmasi' => $statusDikonfirmasi,
            'diantar' => $statusDiantar,
            'selesai' => $statusSelesai,
        ];
        
        $maxStatus = max($statusData) ?? 1;
        $chartStatusHeights = [];
        foreach ($statusData as $status => $count) {
            if ($maxStatus > 0) {
                $height = ($count / $maxStatus) * 300;
            } else {
                $height = 0;
            }
            $chartStatusHeights[$status] = $height;
        }

        // Total pelanggan
        $totalPelanggan = Pelanggan::count();
        
        // Total menu aktif
        $totalMenu = Menu::count();
        
        // Total pesanan bulan ini
        $totalPesananBulanIni = Pesanan::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Pesanan terbaru (Latest 5)
        $pesananTerbaru = Pesanan::with('pelanggan', 'menu')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Total pendapatan bulan ini
        $pendapatanBulanan = Pesanan::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_harga');

        // Saran terbaru
        $saran = Saran::orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact(
            'pendapatanKemarin',
            'pendapatanHariIni',
            'perubahanPendapatan',
            'totalPesananHariIni',
            'totalPesananKemarin',
            'perubahanPesanan',
            'statusPending',
            'statusDikonfirmasi',
            'statusDiantar',
            'statusSelesai',
            'totalPesananSemuanya',
            'chartStatusHeights',
            'totalPelanggan',
            'totalMenu',
            'totalPesananBulanIni',
            'pesananTerbaru',
            'pendapatanBulanan',
            'saran'
        ));
    }
    public function view(Request $request){
        $menu = Menu::all();
        $pelanggan = Pelanggan::all();
        $pesanan = Pesanan::all();
        
        $query = DetailPesanan::with('pesanan.pelanggan', 'menu', 'pesanan.pembayaran');
        
        // Search berdasarkan nama pelanggan, alamat, atau menu
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('pesanan', function ($q) use ($search) {
                $q->whereHas('pelanggan', function ($pelangganQuery) use ($search) {
                    $pelangganQuery->where('nama', 'like', '%' . $search . '%')
                                   ->orWhere('alamat', 'like', '%' . $search . '%');
                })->orWhereHas('menu', function ($menuQuery) use ($search) {
                    $menuQuery->where('nama_menu', 'like', '%' . $search . '%');
                });
            });
        }
        
        // Filter berdasarkan status pesanan
        if ($request->filled('status')) {
            $status = $request->input('status');
            $query->whereHas('pesanan', function ($q) use ($status) {
                $q->where('status_pesanan', $status);
            });
        }
        
        // Urutkan dari pesanan terbaru ke terlama
        $detail_pesanan_raw = $query->orderBy('created_at', 'desc')->get();
        
        // Group pesanan berdasarkan nama pelanggan dan alamat
        $grouped_pesanan = [];
        foreach ($detail_pesanan_raw as $detail) {
            $nama_pelanggan = $detail->pesanan?->pelanggan?->nama ?? '-';
            $alamat_pelanggan = $detail->pesanan?->pelanggan?->alamat ?? '-';
            $no_telepon = $detail->pesanan?->pelanggan?->no_telepon ?? '-';
            $catatan = $detail->catatan ?? '-';
            $key = $nama_pelanggan . '|' . $alamat_pelanggan;
            
            if (!isset($grouped_pesanan[$key])) {
                $grouped_pesanan[$key] = [
                    'nama' => $nama_pelanggan,
                    'alamat' => $alamat_pelanggan,
                    'no_telepon' => $no_telepon,
                    'catatan' => $catatan,
                    'pesanan' => $detail->pesanan,
                    'menus' => [],
                ];
            }
            
            $menu_nama = $detail->menu?->nama_menu ?? '-';
            $jumlah = $detail->jumlah_pesanan ?? 1;
            
            if (isset($grouped_pesanan[$key]['menus'][$menu_nama])) {
                $grouped_pesanan[$key]['menus'][$menu_nama] += $jumlah;
            } else {
                $grouped_pesanan[$key]['menus'][$menu_nama] = $jumlah;
            }
        }
        
        $detail_pesanan = array_values($grouped_pesanan);
        $searchQuery = $request->input('search') ?? '';
        $statusFilter = $request->input('status') ?? '';
        
        return view('admin.pemesanan', compact('menu','pelanggan','pesanan','detail_pesanan', 'searchQuery', 'statusFilter'));
    }
    
    public function updatePesananStatus($pesanan_id)
    {
        try {
            $pesanan = Pesanan::findOrFail($pesanan_id);
            
            // Status progression: pending -> dikonfirmasi -> diantar -> sampai_tujuan -> selesai
            $statusProgression = [
                'pending' => 'dikonfirmasi',
                'dikonfirmasi' => 'diantar',
                'diantar' => 'sampai_tujuan',
                'sampai_tujuan' => 'selesai',
                'selesai' => 'selesai' // Tidak bisa diubah lagi
            ];
            
            $currentStatus = $pesanan->status_pesanan ?? 'pending';
            $nextStatus = $statusProgression[$currentStatus] ?? 'pending';
            
            $pesanan->update([
                'status_pesanan' => $nextStatus
            ]);
            
            return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui menjadi ' . $nextStatus);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui status pesanan: ' . $e->getMessage());
        }
    }

    public function confirmPembayaran($pembayaran_id)
    {
        try {
            $pembayaran = Pembayaran::findOrFail($pembayaran_id);
            
            $pembayaran->update([
                'status_pembayaran' => 'dibayar',
                'tanggal_pembayaran' => now()
            ]);
            
            // Check if request expects JSON
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pembayaran telah dikonfirmasi dan status diubah menjadi Dibayar'
                ], 200);
            }
            
            return redirect()->back()->with('success', 'Pembayaran telah dikonfirmasi dan status diubah menjadi Dibayar');
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengonfirmasi pembayaran: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Gagal mengonfirmasi pembayaran: ' . $e->getMessage());
        }
    }

    public function penjualan()
    {
        // Pendapatan kemarin
        $yesterday = now()->subDay();
        $pendapatanKemarin = Pesanan::whereDate('created_at', $yesterday->toDateString())
            ->sum('total_harga');

        // Pendapatan hari ini
        $today = now();
        $pendapatanHariIni = Pesanan::whereDate('created_at', $today->toDateString())
            ->sum('total_harga');

        // Persentase perubahan
        $perubahan = $pendapatanKemarin > 0 
            ? (($pendapatanHariIni - $pendapatanKemarin) / $pendapatanKemarin) * 100 
            : 0;

        // Data penjualan bulanan
        $penjualanBulanan = [];
        $maxPenjualan = 1;
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $total = Pesanan::whereMonth('created_at', $bulan)
                ->whereYear('created_at', now()->year)
                ->sum('total_harga');
            $penjualanBulanan[] = (int)$total;
            if ($total > $maxPenjualan) {
                $maxPenjualan = $total;
            }
        }

        // Normalisasi tinggi chart (skala 0-300px)
        $chartHeights = [];
        foreach ($penjualanBulanan as $nilai) {
            if ($maxPenjualan > 0) {
                $height = ($nilai / $maxPenjualan) * 300;
            } else {
                $height = 0;
            }
            $chartHeights[] = $height;
        }

        // Menu terlaris
        $menuTerlaris = DetailPesanan::select('menu_id')
            ->selectRaw('SUM(jumlah_pesanan) as total_penjualan')
            ->with('menu')
            ->groupBy('menu_id')
            ->orderBy('total_penjualan', 'desc')
            ->limit(3)
            ->get();

        // Pendapatan bulanan tahun ini
        $pendapatanBulanan = Pesanan::whereYear('created_at', now()->year)
            ->sum('total_harga');

        // Pesanan terbaru
        $pesananTerbaru = Pesanan::with('pelanggan')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.penjualan', [
            'pendapatanKemarin' => $pendapatanKemarin,
            'pendapatanHariIni' => $pendapatanHariIni,
            'perubahan' => $perubahan,
            'chartHeights' => $chartHeights,
            'menuTerlaris' => $menuTerlaris,
            'pendapatanBulanan' => $pendapatanBulanan,
            'pesananTerbaru' => $pesananTerbaru,
        ]);
    }
}
