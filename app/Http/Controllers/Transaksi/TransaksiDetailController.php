<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Psr\Http\Message\ResponseInterface;

class TransaksiDetailController extends Controller
{
    public function store(Request $request, Transaksi $transaksi){
        $validator = Validator::make($request->only(['menus']), [
            'menus' => ['required', 'exists:menus,id', 'array'],
            'menus.id' => ['required', 'numeric'],
            'menus.jumlah' => ['required', 'numeric'],
            'menus.harga' => ['required', 'numeric'],
        ]);

        if($validator->fails()){
            return response()->json([
                'messages' => $validator->errors()
            ]);
        }

        $dataInsert = array_map(function ($menu) use($transaksi){
            return [
                'transaksi_id' => $transaksi->id,
                'menu_id' => $menu->id,
                'jumlah' => $menu->jumlah,
                'harga' => $menu->harga,
            ];
        }, $request->menus);

        $transaksiDetail = TransaksiDetail::insert($dataInsert);

        if(!$transaksiDetail){
            return response()->json([
                'messages' => 'gagal',
            ]);
        }

        return response()->json([
            'messages' => 'berhasil',
            'data' => $transaksiDetail
        ]);
    }

    public function updateTransaksi(Request $request, $id){
        $user = $request->user();
        $transaksiDetail = TransaksiDetail::with('transaksi')->find($id);

        $transaksiDetail->status = $request->status;
        $transaksiDetail->save();

        // push notification firebase ke akun user dan yang bersangkutan (ke tenant atau ke masbro)
        // device token bisa dapat dari var $user

        return response()->json([
            "status" => "success",
            "message" => "berhasil update data",
            "data" => $transaksiDetail
        ]);
    }
}
