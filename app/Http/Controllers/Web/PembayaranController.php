<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tenants;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $tenants = Tenants::leftJoin('menus', 'menus.tenant_id', 'tenants.id')
                            ->leftJoin('transaksi_detail', 'transaksi_detail.menu_id', 'menus.id')
                            ->leftJoin('transaksi', 'transaksi_detail.transaksi_id', 'transaksi.id')
                            ->select(
                                'tenants.nama_tenant',
                                DB::raw('COALESCE(SUM(transaksi_detail.harga * transaksi_detail.jumlah), 0) as biaya'),
                                DB::raw('GROUP_CONCAT(transaksi_detail.id) as transaksi_detail_ids')
                            )
                            ->groupBy('tenants.id', 'tenants.nama_tenant')
                            ->where('transaksi.metode_pembayaran', 'transfer')
                            ->where('transaksi.status', 'selesai')
                            ->where('transaksi_detail.status', '!=', 'selesai')
                            ->get();

        return view('pages.pembayaran.index', compact('tenants'));
    }

    public function transfer(Request $request)
    {
        $TransaksiDetail = TransaksiDetail::whereIn('id', $request->ids)->update(['status' => 'selesai']);

        if($TransaksiDetail){
            return redirect()->route('pembayaran.index')->with(["status" => "success", 'message' => "Transfer berhasil ditambahkan"]);
        }else{
            return redirect()->route('pembayaran.index')->with(["status" => "failed", 'message' => "Transfer gagal ditambahkan"]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
