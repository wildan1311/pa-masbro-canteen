<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable=[
        'user_id',
        'ruangan_id',
        'total',
        'isAntar',
        'motode_pembayaran'
    ];

    public function listTransaksiDetail(){
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id', 'id');
    }
}
