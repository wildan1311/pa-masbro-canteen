<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Tenants;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Services\Firebases;
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

    public function orderUser(Request $request){
        $user = $request->user();
        $permission = $user->can('read order user');
        $permission = true;

        if (!$permission) {
            return response()->json([
                'status' => 'failed',
                'message' => 'tidak memiliki akses',
            ], 403);
        }
        $transaksi = Transaksi::with('listTransaksiDetail')->where('user_id', $user->id)->orderBy('status')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'data berhasil didapatkan',
            'data' => [
                'transaksi' => $transaksi
            ],
        ]);

    }
    public function orderTenant(Request $request){
        $user = $request->user();
        $permission = $user->can('read order user');
        $permission = true;

        if (!$permission) {
            return response()->json([
                'status' => 'failed',
                'message' => 'tidak memiliki akses',
            ], 403);
        }
        try{
            $tenant = Tenants::where("user_id", $request->user()->id)->first();
            $baseQuery = DB::table('transaksi_detail')
                ->join('transaksi', 'transaksi.id', 'transaksi_detail.transaksi_id')
                ->join('menus_kelola', 'menus_kelola.id', 'transaksi_detail.menus_kelola_id')
                ->join('menus', 'menus.id', 'menus_kelola.menu_id')
                ->join('tenants', 'tenants.id', 'menus_kelola.tenant_id')
                ->where('tenant_id', @$tenant->id)
                // ->where('status', 'pesanan_masuk')
                ->select('transaksi_detail.*', 'menus.nama as namaMenu', 'tenants.nama_tenant as tenant')
                ->addSelect(DB::raw('transaksi_detail.jumlah * transaksi_detail.harga as subTotal'));
            // ->get();

            $dataPesananMasuk = (clone $baseQuery)->where('transaksi_detail.status', 'pesanan_masuk')->get();
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
    public function orderMasbro(){}

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
            'isAntar' => 'required|boolean',
            'total' => 'required|numeric',
            'ruangan_id' => 'required_if:isAntar,true', //kurang exists in ruangan
            'metode_pembayaran' => 'required',
            'menus' => 'required|array',
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
                    'statu' => 'failed',
                    'message' => 'gagal transaksi detail',
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

    public function webHookMidtrans(Request $request, Firebases $firebases)
    {
        // $payload = $request->getContent();
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        $notif = new \Midtrans\Notification();
        // $signatureKey = env('MIDTRANS_SERVER_KEY');

        $transaction = $notif->transaction_status;
        $order_id = $notif->order_id;

        $transaksi = Transaksi::find($order_id);
        $tenant = $transaksi->listTransaksiDetail->first()->menusKelola->tenants->pemilik;

        if ($transaction == 'settlement') {
            $transaksi->update(['status' => $transaction]);
            $firebases->withNotification('Pesanan Masuk', "Ada Pesanan Masuk!")
                ->sendMessages($tenant->fcm_token);
        } else if ($transaction == 'expire') {
            $transaksi->update(['status' => $transaction]);
        } else if ($transaction == 'cancel') {
            $transaksi->update(['status' => $transaction]);
        }

        return response()->json(['message' => 'Webhook received']);
    }
}
