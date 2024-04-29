<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menus extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'menus';
    protected $fillable = [
        'nama',
        'kategori_id',
        'gambar',
        'deskripsi',
        'harga',
        'tenant_id',
        'isReady',
    ];

    // menus dikelolah oleh banyak tenants
    // public function listTenant()
    // {
    //     return $this->belongsToMany(Tenants::class, 'menus_kelola', 'tenant_id', 'menu_id')->withPivot(['harga', 'gambar']);
    // }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function getKategoriMenuAttribute()
    {
        return $this->kategori->nama;
    }
    public function tenants()
    {
        return $this->belongsTo(Tenants::class, 'tenant_id');
    }
    public function getLinkGambarAttribute()
    {
        return $this->gambar != '' ? (asset($this->gambar)) : asset('assets/images/default-image.png');
    }
}
