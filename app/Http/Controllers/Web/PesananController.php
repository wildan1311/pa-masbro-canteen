<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tenants;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $this->authorize('read pesanan');
        $user = Auth::user();

        $tenant = Tenants::where("user_id", $user->id)->first();
        $dataPesanan = Transaksi::with([
            'listTransaksiDetail' => function ($query) use ($tenant) {
                $query->whereHas('menusKelola', function($menusKelola) use($tenant){
                    $menusKelola->where('tenant_id', $tenant->id);
                });
            }
        , 'user'])->whereHas('listTransaksiDetail.menusKelola.tenants', function ($query) use ($tenant) {
            $query->where('id', $tenant->id);
        })->whereNotIn('status', ['pending', 'expire', 'cancel'])->get();

        // dd($dataPesanan);

        return view('pages.pesanan.index', compact('dataPesanan'));
    }
}
