<?php

namespace App\Http\Controllers\Kelola;

use App\Http\Controllers\Controller;
use App\Models\Tenants;
use App\Models\Transaksi;
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
        $user = $request->user();

        if (!$user->can('read order tenant')) {
            return response()->json([
                'status' => 'failed',
                'message' => 'tidak memiliki akses',
            ], 403);
        }

        try {
            $tenant = Tenants::where("user_id", $request->user()->id)->first();
            $dataPesanan = Transaksi::with([
                'listTransaksiDetail.menusKelola' => function ($query) use ($tenant) {
                    $query->where('tenant_id', @$tenant->id);
                }
            ])->whereHas('listTransaksiDetail.menusKelola', function ($query) use ($tenant) {
                $query->where('tenant_id', @$tenant->id);
            })->whereNotIn('status', ['pending', 'expire', 'cancel'])->get();

            // $baseQuery = DB::table('transaksi_detail')
            //     ->join('transaksi', 'transaksi.id', 'transaksi_detail.transaksi_id')
            //     ->join('menus_kelola', 'menus_kelola.id', 'transaksi_detail.menus_kelola_id')
            //     ->join('menus', 'menus.id', 'menus_kelola.menu_id')
            //     ->join('tenants', 'tenants.id', 'menus_kelola.tenant_id')
            //     ->where('tenant_id', @$tenant->id)
            //     // ->where('status', 'pesanan_masuk')
            //     ->select('transaksi.id', 'transaksi_detail.*', 'menus.nama as namaMenu', 'tenants.nama_tenant as tenant')
            //     ->addSelect(DB::raw('transaksi_detail.jumlah * transaksi_detail.harga as subTotal'));
            // // ->get();

            if ($request->status) {
                $dataPesanan = ($dataPesanan)->where('status', $request->status);
            }

            return response()->json([
                "status" => "success",
                "message" => "Berhasil mengambil data",
                "data" => [
                    "pesanan" => $dataPesanan,
                ]
            ]);
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "status" => "server error",
                "message" => "terjadi kesalahan di server"
            ], 500);
        }
    }

    // multitenant
    // public function update(Request $request, $transaksiDetailId){
    //     $user = $request->user();

    //     if(!$user->can('update order tenant')){
    //         return response()->json([
    //             'status' => 'failed',
    //             'message' => 'tidak memiliki akses',
    //         ], 403);
    //     }

    //     $transaksiDetail = TransaksiDetail::find($transaksiDetailId);

    //     if(!$transaksiDetail){
    //         return response()->json([
    //             "status" => "Bad Request",
    //             "message" => "Transaksi Detail Id tidak ditemukan"
    //         ], 401);
    //     }

    //     $validator = Validator::make($request->all(), [
    //         'status' => ['required', 'in:siap_diantar,pesanan_masuk'],
    //     ]);

    //     if($validator->fails()){
    //         return response()->json([
    //             "status" => "Bad Request",
    //             "message" => $validator->errors()
    //         ], 400);
    //     }

    //     $transaksiDetail->status = $request->status;
    //     $transaksiDetail->save();
    //     $transaksi = $transaksiDetail->transaksi;

    //     // firebase notification to bersangkutan
    //     if($transaksiDetail->status == 'pesanan_ditolak'){
    //         // todo : refund
    //     }

    //     if($transaksiDetail->status == 'pesanan_diterima'){
    //         $banyak_transaksi_yang_diterima = Transaksi::withCount(['listTransaksiDetail' => function($query){
    //             $query->where('status', 'pesanan_diterima');
    //         }])->find($transaksi->id)->list_transaksi_detail_count;

    //         if($transaksi->listTransaksiDetail->count() == $banyak_transaksi_yang_diterima){
    //             $transaksi->update(['status'=>'sedang_diolah']);
    //             // todo : notif ke user
    //         }
    //     }

    //     if($transaksiDetail->status == 'selesai'){
    //         $banyak_transaksi_yang_selesai = Transaksi::withCount(['listTransaksiDetail' => function($query){
    //             $query->where('status', 'selesai');
    //         }])->find($transaksi->id)->list_transaksi_detail_count;

    //         if($transaksi->listTransaksiDetail->count() == $banyak_transaksi_yang_selesai){
    //             if($transaksi->isAntar){
    //                 $transaksi->update(['status'=>'siap_diantar']);
    //                 // todo : notif ke masbro
    //             }else{
    //                 $transaksi->update(['status'=>'selesai']);
    //                 // todo : notif ke user
    //             }
    //         }
    //     }

    //     return response()->json([
    //         "status" => "success",
    //         "messages" => str_replace('_', ' ', $request->status)
    //     ]);
    // }

    // satu tenant
    public function update(Request $request, $id)
    {
        $user = $request->user();

        if (!$user->can('update order tenant')) {
            return response()->json([
                'status' => 'failed',
                'message' => 'tidak memiliki akses',
            ], 403);
        }

        $transaksi = Transaksi::with('user')->find($id);

        if (!$transaksi) {
            return response()->json([
                "status" => "Bad Request",
                "message" => "Transaksi Id tidak ditemukan"
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'status' => ['required', 'in:siap_diantar,pesanan_ditolak,pesanan_diproses'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "Bad Request",
                "message" => $validator->errors()
            ], 400);
        }

        $transaksi->status = $request->status;
        $transaksi->save();

        // firebase notification to bersangkutan
        // todo : notify ke user
        if ($transaksi->status == 'pesanan_ditolak') {
            // todo : refund dan notif ke user bersangkutan
        }

        // if ($transaksi->status == 'pesanan_diproses') {
        //     // todo : notify ke user
        // }

        if ($transaksi->status == 'siap_diantar') {
            //  send push notification ke masbro
        }
        if ($transaksi->status == 'diantar') {
            //  send push notification ke masbro
        }

        if ($transaksi->status == 'selesai') {
            //  send push notification ke masbro
        }

        return response()->json([
            "status" => "success",
            "message" => str_replace('_', ' ', $request->status)
        ]);
    }
}
