<?php

namespace App\Http\Controllers;
Use App\models\Saran;
Use App\Models\DetailPesanan;
Use App\Models\Pesanan;
Use App\Models\Pelanggan;
Use App\Models\Menu;
use Illuminate\Http\Request;

class AdminControler extends Controller
{
    public function index()
    {
        $saran = Saran::all();
        return view('admin.dashboard', compact('saran'));
    }
    public function view(Request $request){
        $menu = Menu::all();
        $pelanggan = Pelanggan::all();
        $pesanan = Pesanan::all();
        
        $query = DetailPesanan::with('pesanan.pelanggan', 'pesanan.menu');
        
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
        
        $detail_pesanan = $query->get();
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
