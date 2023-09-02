<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
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
            'ruangan_id' => 'required_if:isAntar,true',
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
            'metode_pembayaran' => $request->metode_pembayaran
        ]);

        if(!$transaksi){
            return response()->json([
                'messages' => 'gagal',
            ]);
        }

        return redirect()->route('transaksi.detail', [$request, $transaksi]);
    }
}
