<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes;

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

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
