<?php

namespace App\Services;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Collection;
use \Midtrans\Config;
use Midtrans\Snap;

class Midtrans
{
    private $serverKey;
    private $isProduction;
    private $isSanitized;
    private $is3ds;
    private $transaksi;

    public function __construct()
    {
        $this->serverKey = config('midtrans.server_key');
        $this->isProduction = config('midtrans.is_production');
        $this->isSanitized = config('midtrans.is_sanitized');
        $this->is3ds = config('midtrans.is_3ds');

        $this->__configureMidtrans();
    }

    public function __configureMidtrans()
    {
        Config::$serverKey = $this->serverKey;
        Config::$isProduction = $this->isProduction;
        Config::$isSanitized = $this->isSanitized;
        Config::$is3ds = $this->is3ds;
    }

    public function createParams()
    {
        return [
            'transaction_details' => $this->getTransaksiDetail(),
            'item_details' => $this->getTransaksiItemsDetail(),
            'customer_details' => $this->getUserDetail()
        ];
    }

    public function getTransaksiItemsDetail()
    {
        $itemsDetail = $this->transaksi->listTransaksiDetail->map(function ($item) {
            return [
                "id" => $item->id,
                "price" => $item->harga,
                "quantity" => $item->jumlah,
                // "merchant_name" =>
                // "name"
            ];
        });
        return $itemsDetail;
    }

    public function getTransaksiDetail()
    {
        return array(
            "order_id" => $this->transaksi->id,
            'gross_amount' => $this->transaksi->total,
        );
    }

    public function getUserDetail()
    {
        return array(
            'first_name' => $this->transaksi->user->name,
            'email' => $this->transaksi->user->email,
        );
    }

    public function createSnapTransaction(Transaksi $transaksi)
    {
        $this->transaksi = $transaksi;
        $params = $this->createParams();
        $snapTransaksi = Snap::createTransaction($params);
        return $snapTransaksi;
    }
}
