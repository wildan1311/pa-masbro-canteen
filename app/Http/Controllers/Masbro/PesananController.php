<?php

namespace App\Http\Controllers\Masbro;

use App\Http\Controllers\Controller;
use App\Models\Tenants;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if(!$user->can('read order masbro')){
            return response()->json([
                'status' => 'failed',
                'message' => 'tidak memiliki akses',
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:diantar,selesai,siap_diantar',
            'gedung' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "Bad Request",
                "message" => $validator->errors()
            ], 400);
        }

        try {
            // $tenant = Tenants::where("user_id", $request->user()->id)->first();
            $transaksi = DB::table('transaksi_detail')
                ->join('transaksi', 'transaksi.id', 'transaksi_detail.transaksi_id')
                ->join('menus_kelola', 'menus_kelola.id', 'transaksi_detail.menus_kelola_id')
                ->join('menus', 'menus.id', 'menus_kelola.menu_id')
                ->join('tenants', 'tenants.id', 'menus_kelola.tenant_id')
                ->join('users', 'users.id', 'transaksi.user_id')
                ->join('ruangan', 'ruangan.id', 'transaksi.ruangan_id')
                ->join('gedung', 'gedung.id', 'ruangan.gedung_id')
                // ->where('status', 'siap_diantar')
                ->select('transaksi_detail.*', 'menus.nama as namaMenu', 'tenants.nama_tenant as tenant', 'users.name as nama_user', 'ruangan.nama as nama_ruangan', 'gedung.nama as nama_gedung', 'transaksi.id as transaksi_id')
                ->addSelect(DB::raw('transaksi_detail.jumlah * transaksi_detail.harga as subTotal'));
            // ->get();

            if($request->gedung){
                $transaksi = $transaksi->where('gedung.nama', $request->gedung);
            }

            if($request->status){
                $transaksi = ($transaksi)->where('transaksi.status', $request->status);
            }

            $transaksi = $transaksi->get()->groupBy('transaksi_id');

            // $transaksi_diantar = (clone $transaksi_siap_diantar)->where('transaksi.status', 'diantar')->get()->groupBy('transaksi_id');
            // $transaksi_selesai = (clone $transaksi_siap_diantar)->where('transaksi.status', 'selesai')->get()->groupBy('transaksi_id');
            // $transaksi_siap_diantar = $transaksi_siap_diantar->where('transaksi.status', 'siap_diantar')->get()->groupBy('transaksi_id');

            return response()->json([
                "status" => "success",
                "message" => "Berhasil mengambil data",
                "data" => [
                    'order' => $transaksi,
                    // 'transaksi_siap_diantar' => $transaksi_siap_diantar,
                    // 'transaksi_diantar' => $transaksi_diantar,
                    // 'transaksi_selesai' => $transaksi_selesai,
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

    public function update(Request $request, $transaksiId)
    {
        $user = $request->user();

        if(!$user->can('update order masbro')){
            return response()->json([
                'status' => 'failed',
                'message' => 'tidak memiliki akses',
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:diantar,selesai,siap_diantar',
            // 'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "Bad Request",
                "message" => $validator->errors()
            ], 400);
        }

        try {
            $transaksi = Transaksi::find($transaksiId);
            if (!$transaksi) {
                return response()->json([
                    "status" => "Not Found",
                    "message" => "Transaksi tidak ditemukan"
                ], 404);
            } else {
                $transaksi->status = 'selesai';
                $transaksi->save();
                // Jika status transaksi berubah menjadi Siap Diant
                return response()->json([
                    "status" => "success",
                    "message" => "Pesanan Sudah Selesai",
                ]);
            }
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "status" => "server error",
                "message" => "terjadi kesalahan di server"
            ], 500);
        }
    }
}
