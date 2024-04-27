<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaksi';
    protected $fillable = [
        'user_id',
        'status',
        'ruangan_id',
        'total',
        'ongkos_kirim',
        'biaya_layanan',
        'isAntar',
        'metode_pembayaran',
        'catatan'
    ];

    public $appends = ['sub_total', 'gedung', 'nama_ruangan'];

    public function getSubTotalAttribute()
    {
        return $this->listTransaksiDetail()->sum(DB::raw('harga * jumlah'));
    }
    public function getGedungAttribute()
    {
        return @$this->ruangan->gedung->nama;
    }
    public function getNamaRuanganAttribute()
    {
        return @$this->ruangan->nama_ruangan;
    }

    public function listTransaksiDetail()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ruangan(){
        return $this->belongsTo(Ruangan::class,'ruangan_id','id');
    }
}
