<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenusKelola extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'menus_kelola';

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'gambar',
        'tenant_id',
        'menu_id',
        'isReady'
    ];

    public $appends = ['nama_menu', 'kategori_menu', 'link_gambar'];

    public function getNamaMenuAttribute(){
        return $this->menus->nama;
    }
    public function getKategoriMenuAttribute(){
        return $this->menus->kategori->nama;
    }
    public function menus(){
        return $this->belongsTo(Menus::class, 'menu_id');
    }
    public function tenants(){
        return $this->belongsTo(Tenants::class, 'tenant_id');
    }
    public function getLinkGambarAttribute()
    {
        return $this->gambar != '' ? (asset($this->gambar)) : asset('assets/images/default-image.png');
    }
}
