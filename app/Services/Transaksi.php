<?php

namespace App\Services;

use Illuminate\Support\Collection;

class Transaksi {
    /**
     * Undocumented variable
     *
     * @var Collection $transaksi
     */
    protected $transaksi;
    public $jumlahPesananMasuk;
    public $jumlahPesananDitolak;
    public $jumlahPesananSelesai;

    public function __construct(Collection $transaksi){
        $this->transaksi = $transaksi;
        $this->calculateJumlahPesananSelesai();
        $this->calculateJumlahPesananMasuk();
        $this->calculateJumlahPesananDitolak();
    }

    public function createTransaksi(){}
    public function createTransaksiPG(){}

    /**
     * Calculate Sub Total Every Transaction
     *
     * @return int
     */
    public function calculateSubTotal(){
        $subTotal = $this->transaksi->where("status", "selesai")->sum(function($item) {
            return $item['jumlah'] * $item['harga'];
        });

        return $subTotal;
    }

    public function calculateJumlahPesananMasuk(){
        $this->jumlahPesananMasuk = $this->transaksi->count() ?? 0;
    }
    public function calculateJumlahPesananSelesai(){
        $this->jumlahPesananSelesai = $this->transaksi->where("status", "selesai")->count() ?? 0;
    }
    public function calculateJumlahPesananDitolak(){
        $this->jumlahPesananDitolak = $this->transaksi->where("status", "pesanan_ditolak")->count() ?? 0;
    }
}



