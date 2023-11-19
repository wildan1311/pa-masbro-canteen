<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index(){

    }

    public function store(Request $request){
        $validatator = Validator::make($request->all(), [
            'user_id' => 'required',
            'isAntar' => 'required|boolean',
            'total' => 'required|numeric',
            'ruangan_id' => 'required_if:isAntar,true', //kurang exists in ruangan
            'metode_pembayaran' => 'required',
        ]);

        if($validatator->fails()){
            return response()->json([
                'messages' => $validatator->errors()
            ]);
        }

        $transaksi = Transaksi::create([
            'user_id' => $request->user_id,
            'total' => $request->total,
            'isAntar' => $request->isAntar,
            'metode_pembayaran' => $request->metode_pembayaran,
            'ruangan_id' => $request->ruangan_id,
        ]);

        if(!$transaksi){
            return response()->json([
                'messages' => 'gagal',
            ]);
        }

        $transaksiDetail = $this->storeTransakasiDetail($request, $transaksi);

        if($transaksiDetail){
            return response()->json([
                'messages' => "berhasil",
                // "transaksi" =>
            ], 201);
        }else{
            return response()->json([
                'messages' => 'gagal transaksi detail',
            ], 401);
        }
    }

    public function storeTransakasiDetail($request, $transaksi){
        $validator = Validator::make($request->only(['menus']), [
            'menus' => ['required', 'array'],
            'menus.*.id' => ['required', 'numeric'],
            'menus.*.jumlah' => ['required', 'numeric'],
            'menus.*.harga' => ['required', 'numeric'],
        ], [

        ]);

        if($validator->fails()){
            return response()->json([
                'messages' => $validator->errors()
            ], 400);
        }

        $dataInsert = array_map(function ($menu) use($transaksi){
            return [
                'transaksi_id' => $transaksi->id,
                'menu_id' => $menu['id'],
                'jumlah' => $menu['jumlah'],
                'harga' => $menu['harga'],
            ];
        }, $request->menus);

        try {
            $transaksiDetail = TransaksiDetail::insert($dataInsert);
        } catch (\Throwable $th) {
            return false;
        }

        return $transaksiDetail;
    }
}
