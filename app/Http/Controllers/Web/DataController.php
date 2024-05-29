<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tenants;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Services\Transaksi as ServicesTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $this->authorize('read data');

        $tenant = Tenants::where("user_id", $user->id)->first();
        $dataPesanan = Transaksi::with([
            'listTransaksiDetail' => function ($query) use ($tenant) {
                $query->whereHas('menus', function ($menus) use ($tenant) {
                    $menus->where('tenant_id', $tenant->id);
                });
            }, 'user'
        ])->whereHas('listTransaksiDetail.menus.tenants', function ($query) use ($tenant) {
            $query->where('id', $tenant->id);
        })->join('transaksi_detail', 'transaksi_detail.transaksi_id', 'transaksi.id')
            ->select('*', 'transaksi.status', 'transaksi.id')
            ->addSelect(DB::raw('transaksi_detail.harga * transaksi_detail.jumlah as subTotal'));

        $transaksi = new ServicesTransaksi($dataPesanan->get());

        $jumlahPesananDitolak = $transaksi->jumlahPesananDitolak;
        $jumlahPesananMasuk = $transaksi->jumlahPesananMasuk;
        $jumlahPesananSelesai = $transaksi->jumlahPesananSelesai;

        $dataPesananSelesai = (clone $dataPesanan)->whereIn('transaksi.status', ["selesai", "diantar"]);

        $grafik = $dataPesananSelesai->select(
            DB::raw("CASE
                WHEN MONTH(transaksi.created_at) = 1 THEN 'Januari'
                WHEN MONTH(transaksi.created_at) = 2 THEN 'Februari'
                WHEN MONTH(transaksi.created_at) = 3 THEN 'Maret'
                WHEN MONTH(transaksi.created_at) = 4 THEN 'April'
                WHEN MONTH(transaksi.created_at) = 5 THEN 'Mei'
                WHEN MONTH(transaksi.created_at) = 6 THEN 'Juni'
                WHEN MONTH(transaksi.created_at) = 7 THEN 'Juli'
                WHEN MONTH(transaksi.created_at) = 8 THEN 'Agustus'
                WHEN MONTH(transaksi.created_at) = 9 THEN 'September'
                WHEN MONTH(transaksi.created_at) = 10 THEN 'Oktober'
                WHEN MONTH(transaksi.created_at) = 11 THEN 'November'
                ELSE 'Desember' END as nama_bulan"),
            DB::raw('YEAR(transaksi.created_at) as tahun'),
            DB::raw('(sum(jumlah*harga)) as total_pesanan')
        )
            ->groupBy(DB::raw('YEAR(transaksi.created_at)'), DB::raw('nama_bulan'))
            ->orderBy(DB::raw('tahun'))
            ->orderBy(DB::raw('nama_bulan'))
            ->get();

        $listTransaksiDetail = TransaksiDetail::whereIn('transaksi_id', $dataPesanan->pluck('transaksi.id')->toArray())
            // ->join('menus_kelola', 'menus_kelola.id', 'transaksi_detail.menus_kelola_id')
            ->join('menus', 'menus.id', 'transaksi_detail.menu_id')
            ->groupBy('menu_id')
            ->select(['menu_id', DB::raw('MAX(menus.gambar) as gambar'), DB::raw('MAX(menus.nama) as nama')])
            ->addSelect(DB::raw('sum(jumlah) as total_pembelian'))
            ->limit(5)
            ->orderByDesc('total_pembelian')
            ->get();

        $totalKeuangan = $transaksi->calculateSubTotal();

        return view('pages.data.index', compact('jumlahPesananMasuk', 'jumlahPesananSelesai', 'jumlahPesananDitolak', 'totalKeuangan', 'listTransaksiDetail', 'grafik'));
    }
}
