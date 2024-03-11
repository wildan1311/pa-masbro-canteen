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
        'harga',
        'gambar',
        'tenant_id',
        'menu_id',
        'isReady'
    ];

    public $appends = ['nama_menu', 'kategori_menu'];

    public function getNamaMenuAttribute(){
        return $this->menus->nama;
    }
    public function getKategoriMenuAttribute(){
        return $this->menus->kategori->name;
    }
    public function menus(){
        return $this->belongsTo(Menus::class, 'menu_id');
    }
    public function tenants(){
        return $this->belongsTo(Tenants::class, 'tenant_id');
    }
}
