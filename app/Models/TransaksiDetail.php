<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaksi_detail';
    protected $fillable = [
        'menus_kelola_id',
        'transaksi_id',
        'jumlah',
        'harga',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function menusKelola(){
        return $this->belongsTo(MenusKelola::class, 'menus_kelola_id', 'id');
    }
}
