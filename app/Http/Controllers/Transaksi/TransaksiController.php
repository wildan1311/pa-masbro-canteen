<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Services\Midtrans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $user = $request->user();
        $validatator = Validator::make($request->all(), [
            'user_id' => 'required',
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

        $transaksi = Transaksi::create([
            'user_id' => $request->user_id,
            'total' => $request->total,
            'isAntar' => $request->isAntar,
            'metode_pembayaran' => $request->metode_pembayaran,
            'ruangan_id' => $request->ruangan_id,
        ]);

        if (!$transaksi) {
            return response()->json([
                'messages' => 'gagal',
            ]);
        }

        $success = $this->storeTransakasiDetail($request, $transaksi);

        if ($success) {
            // do midtrans
            $transaksi = Transaksi::with(['user', 'listTransaksiDetail'])->where('id', $transaksi->id)->first();
            $midtrans = new Midtrans();
            $snapMidtrans = $midtrans->createSnapTransaction($transaksi);
            // dd($transaksi);
            // \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY_DEV');
            // \Midtrans\Config::$isProduction = false;

            // $transaksiDetail = TransaksiDetail::where("transaksi_id", $transaksi->id)->get();

            // $itemsDetail = $transaksiDetail->map(function ($item) {
            //     return [
            //         "id" => $item->id,
            //         "price" => $item->harga,
            //         "quantity" => $item->jumlah,
            //         // "merchant_name" =>
            //         // "name"
            //     ];
            // });

            // $params = array(
            //     'transaction_details' => array(
            //         'order_id' => $transaksi->id,
            //         'gross_amount' => $transaksi->total,
            //     ),
            //     "items_detail" => $itemsDetail,
            //     "customer_details" => array(
            //         "first_name" => $user->name,
            //         "email" => $user->email,
            //     )
            // );

            // $snapMidtrans = \Midtrans\Snap::createTransaction($params);

            return response()->json([
                "status" => 'success',
                'messages' => "transaksi berhasil dibuat",
                "snap" => $snapMidtrans
            ], 201);
        } else {
            return response()->json([
                'messages' => 'gagal transaksi detail',
            ], 401);
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

        try {
            $transaksiDetail = TransaksiDetail::insert($dataInsert);
        } catch (\Throwable $th) {
            return false;
        }

        return $transaksiDetail;
    }
}
