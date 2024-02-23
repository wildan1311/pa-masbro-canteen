<?php

namespace App\Http\Controllers\Kelola;

use App\Http\Controllers\Controller;
use App\Models\Tenants;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class TenantOrderController extends Controller
{
    public function index(Request $request)
    {
        try{
            $tenant = Tenants::where("user_id", $request->user()->id)->first();
            $baseQuery = DB::table('transaksi_detail')
                ->join('transaksi', 'transaksi.id', 'transaksi_detail.transaksi_id')
                ->join('menus_kelola', 'menus_kelola.id', 'transaksi_detail.menus_kelola_id')
                ->join('menus', 'menus.id', 'menus_kelola.menu_id')
                ->join('tenants', 'tenants.id', 'menus_kelola.tenant_id')
                ->where('tenant_id', $tenant->id)
                // ->where('status', 'pesanan_masuk')
                ->select('transaksi_detail.*', 'menus.nama as namaMenu', 'tenants.nama_tenant as tenant')
                ->addSelect(DB::raw('transaksi_detail.jumlah * transaksi_detail.harga as subTotal'));
            // ->get();

            $dataPesananMasuk = (clone $baseQuery)->where('status', 'pesanan_masuk')->get();
            $dataPesanan = (clone $baseQuery)->get();
            return response()->json([
                "status" => "success",
                "message" => "Berhasil mengambil data",
                "data" => [
                    "pesanan_masuk" => $dataPesananMasuk,
                    "riwayat_pesanan" => $dataPesanan
                ]
            ]);
        }catch(Throwable $th){
            Log::error($th->getMessage());
            return response()->json([
                "status" => "server error",
                "message" => "terjadi kesalahan di server"
            ], 500);
        }
    }

    public function acceptOrRejectOrder(Request $request, $transaksiDetailId){
        $transaksiDetail = TransaksiDetail::find($transaksiDetailId);

        $validator = Validator::make($request->all(), [
            'status' => ['required'],
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => "Bad Request",
                "message" => $validator->errors()
            ], 400);
        }

        $transaksiDetail->status = $request->status;
        $transaksiDetail->save();

        // firebase notification to bersangkutan
        if($transaksiDetail->status == 'pesanan_ditolak'){
            // kirim ke user
            // bingung : gimana cara nolaknya, kan yg ditolak menunya,
        }

        return response()->json([
            "status" => "success",
            "messages" => str_replace('_', ' ', $request->status)
        ]);
    }
}
