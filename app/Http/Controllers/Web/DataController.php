<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tenants;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $tenant = Tenants::where("user_id", $user->id)->first();
        $dataPesanan = Transaksi::with([
            'listTransaksiDetail' => function ($query) use ($tenant) {
                $query->whereHas('menusKelola', function ($menusKelola) use ($tenant) {
                    $menusKelola->where('tenant_id', $tenant->id);
                });
            }, 'user'
        ])->whereHas('listTransaksiDetail.menusKelola.tenants', function ($query) use ($tenant) {
            $query->where('id', $tenant->id);
        });

        $jumlahPesananMasuk = (clone $dataPesanan)->count();
        $jumlahPesananSelesai = (clone $dataPesanan)->where('status', 'selesai')->count();
        $jumlahPesananDitolak = (clone $dataPesanan)->where('status', 'pesanan_ditolak')->count();
        $dataPesananSelesai = (clone $dataPesanan)->whereIn('status', ["selesai", "diantar"]);

        // dd($dataPesananSelesai->get());

        $grafik = $dataPesananSelesai->select(
            DB::raw("CASE
                WHEN MONTH(created_at) = 1 THEN 'Januari'
                WHEN MONTH(created_at) = 2 THEN 'Februari'
                WHEN MONTH(created_at) = 3 THEN 'Maret'
                WHEN MONTH(created_at) = 4 THEN 'April'
                WHEN MONTH(created_at) = 5 THEN 'Mei'
                WHEN MONTH(created_at) = 6 THEN 'Juni'
                WHEN MONTH(created_at) = 7 THEN 'Juli'
                WHEN MONTH(created_at) = 8 THEN 'Agustus'
                WHEN MONTH(created_at) = 9 THEN 'September'
                WHEN MONTH(created_at) = 10 THEN 'Oktober'
                WHEN MONTH(created_at) = 11 THEN 'November'
                ELSE 'Desember' END as nama_bulan"),
            DB::raw('YEAR(created_at) as tahun'),
            DB::raw('(sum(total) - sum(ongkos_kirim) - sum(biaya_layanan)) as total_pesanan')
        )
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('nama_bulan'))
            ->orderBy(DB::raw('tahun'))
            ->orderByRaw('MONTH(created_at)')
            ->get();

        // dd($grafik);

        $listTransaksiDetail = TransaksiDetail::whereIn('transaksi_id', $dataPesanan->pluck('id')->toArray())
            ->join('menus_kelola', 'menus_kelola.id', 'transaksi_detail.menus_kelola_id')
            ->join('menus', 'menus.id', 'menus_kelola.menu_id')
            ->groupBy('menus_kelola_id')
            ->select(['menus_kelola_id', DB::raw('MAX(menus_kelola.gambar) as gambar'), DB::raw('MAX(menus_kelola.nama) as nama'), DB::raw('MAX(menus.nama) as nama_menu')])
            ->addSelect(DB::raw('sum(jumlah) as total_pembelian'))
            ->limit(5)
            ->orderByDesc('total_pembelian')
            ->get();

        $totalKeuangan = 0;
        $dataPesananSelesai = $dataPesananSelesai->get();
        // dd($dataPesananSelesai);
        foreach ($dataPesananSelesai as $pesanan) {
            $totalKeuangan += $pesanan->total_pesanan;
        }

        return view('pages.data.index', compact('jumlahPesananMasuk', 'jumlahPesananSelesai', 'jumlahPesananDitolak', 'totalKeuangan', 'listTransaksiDetail', 'grafik'));
    }
}
