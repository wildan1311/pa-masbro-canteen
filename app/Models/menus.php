<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menus extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'menus';
    protected  $fillable=['nama', 'kategori_id'];

    // menus dikelolah oleh banyak tenants
    public function listTenant(){
        return $this->belongsToMany(Tenants::class,'menus_kelola', 'tenant_id', 'menu_id')->withPivot(['harga', 'gambar']);
    }
    public function kategori(){
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
}
