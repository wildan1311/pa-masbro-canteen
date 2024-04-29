<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tenants;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function index(){
        $this->authorize('read pesanan');
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
        })
        ->whereIn('status', ['selesai'])
        ->get();

        $summary = DB::table('transaksi_detail')
                        ->join('transaksi', 'transaksi.id', 'transaksi_detail.transaksi_id')
                        ->join('menus_kelola', 'transaksi_detail.menus_kelola_id', 'menus_kelola.id')
                        ->join('tenants', 'tenants.id', 'menus_kelola.tenant_id')
                        ->select('transaksi_detail.*', 'transaksi.status as transaksi_status')
                        ->addSelect(DB::raw('transaksi_detail.harga * jumlah as total_harga_menu'))
                        ->where('transaksi.status', 'selesai')
                        ->where('tenants.id', $tenant->id);

        $summary = DB::table(DB::raw("({$summary->toSql()}) as query"))
            ->mergeBindings($summary)
            ->select('query.*');

        $summaryPending = $summary->whereIn('status', ['pending', 'pesanan_masuk'])->sum('total_harga_menu');
        $summaryMingguIni = $summary->whereIn('status', ['sudah_dibayar'])->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total_harga_menu');
        $summaryBulanIni = $summary->whereIn('status', ['sudah_dibayar'])->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('total_harga_menu');
        $summarySemua = $summary->whereIn('status', ['sudah_dibayar'])->sum('total_harga_menu');

        $summary = (Object)[
            "jumlah_pending" => $summaryPending,
            "jumlah_minggu_ini" => $summaryMingguIni,
            "jumlah_bulan_ini" => $summaryBulanIni,
            "jumlah_semua" => $summarySemua,
        ];

        return view('pages.keuangan.index', compact('dataPesanan', 'summary'));
    }
}
