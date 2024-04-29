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
    public function index(){
        $user = Auth::user();

        $tenant = Tenants::where("user_id", $user->id)->first();
        $dataPesanan = Transaksi::with([
            'listTransaksiDetail' => function ($query) use ($tenant) {
                $query->whereHas('menus', function($menus) use($tenant){
                    $menus->where('tenant_id', $tenant->id);
                });
            }
        , 'user'])->whereHas('listTransaksiDetail.menus.tenants', function ($query) use ($tenant) {
            $query->where('id', $tenant->id);
        });

        $jumlahPesananMasuk = (clone $dataPesanan)->where('status', 'pesanan_masuk')->count();
        $jumlahPesananSelesai = (clone $dataPesanan)->where('status', 'selesai')->count();
        $jumlahPesananDitolak = (clone $dataPesanan)->where('status', 'pesanan_ditolak')->count();
        $dataPesananSelesai = (clone $dataPesanan)->where('status', 'selesai')->get();

        $listTransaksiDetail = TransaksiDetail::whereIn('transaksi_id', $dataPesanan->pluck('id')->toArray())
                                ->join('menus_kelola', 'menus_kelola.id', 'transaksi_detail.menus_kelola_id')
                                ->join('menus', 'menus.id', 'menus_kelola.menu_id')
                                ->groupBy('menus_kelola_id')
                                ->select(['menus_kelola_id', DB::raw('MAX(menus_kelola.gambar) as gambar') , DB::raw('MAX(menus_kelola.nama) as nama'), DB::raw('MAX(menus.nama) as nama_menu')])
                                ->addSelect(DB::raw('sum(jumlah) as total_pembelian'))
                                ->limit(5)
                                ->orderByDesc('total_pembelian')
                                ->get();

        $totalKeuangan = 0;
        foreach($dataPesananSelesai as $pesanan){
            $totalKeuangan += $pesanan->subTotal;
        }

        return view('pages.data.index', compact('jumlahPesananMasuk', 'jumlahPesananSelesai', 'jumlahPesananDitolak', 'totalKeuangan', 'listTransaksiDetail'));
    }
}
