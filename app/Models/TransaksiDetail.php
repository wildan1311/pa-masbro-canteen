<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksi_detail';
    protected $fillable=[
        'menu_id',
        'transaksi_id',
        'jumlah',
        'harga',
    ];

    public function transaksi(){
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
