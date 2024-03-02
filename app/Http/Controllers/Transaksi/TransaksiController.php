<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Services\Midtrans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class TransaksiController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $user = $request->user();
        $permission = $user->can('create order');
        $permission = true;

        if (!$permission) {
            return response()->json([
                'status' => 'failed',
                'message' => 'tidak memiliki akses',
            ], 403);
        }

        $validatator = Validator::make($request->all(), [
            // 'user_id' => 'required',
            'isAntar' => 'required|boolean',
            'total' => 'required|numeric',
            'ruangan_id' => 'required_if:isAntar,true', //kurang exists in ruangan
            'metode_pembayaran' => 'required',
        ]);

        if ($validatator->fails()) {
            return response()->json([
                'messages' => $validatator->errors()
            ]);
        }

        DB::beginTransaction();
        try {
            $transaksi = Transaksi::create([
                'user_id' => $user->id,
                'total' => $request->total,
                'isAntar' => $request->isAntar,
                'metode_pembayaran' => $request->metode_pembayaran,
                'ruangan_id' => $request->ruangan_id,
            ]);

            $success = $this->storeTransakasiDetail($request, $transaksi);

            if ($success) {
                $transaksi = Transaksi::with(['user', 'listTransaksiDetail.menusKelola.menus'])->where('id', $transaksi->id)->first();
                $midtrans = new Midtrans();
                $snapMidtrans = $midtrans->createSnapTransaction($transaksi);

                DB::commit();
                return response()->json([
                    "status" => 'success',
                    'messages' => "transaksi berhasil dibuat",
                    "snap" => $snapMidtrans
                ], 201);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'messages' => 'gagal transaksi detail',
                ], 401);
            }

        } catch (Throwable $th) {
            DB::rollback();
            Log::error($th->getMessage());

            return response()->json([
                'status' => 'failed',
                'messages' => 'transaksi gagal',
            ], 400);
        }
    }

    public function storeTransakasiDetail($request, $transaksi)
    {
        $validator = Validator::make($request->only(['menus']), [
            'menus' => ['required', 'array'],
            'menus.*.id' => ['required', 'numeric'],
            'menus.*.jumlah' => ['required', 'numeric'],
            'menus.*.harga' => ['required', 'numeric'],
        ], [

        ]);

        if ($validator->fails()) {
            return response()->json([
                'messages' => $validator->errors()
            ], 400);
        }

        $dataInsert = array_map(function ($menu) use ($transaksi) {
            return [
                'transaksi_id' => $transaksi->id,
                'menus_kelola_id' => $menu['id'],
                'jumlah' => $menu['jumlah'],
                'harga' => $menu['harga'],
            ];
        }, $request->menus);

        $transaksiDetail = TransaksiDetail::insert($dataInsert);

        return $transaksiDetail;
    }

    public function webHookMidtrans(Request $request){

    }
}
