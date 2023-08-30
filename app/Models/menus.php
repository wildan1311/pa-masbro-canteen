<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected  $fillable=['nama'];

    // menus dikelolah oleh banyak tenants
    public function listTenant(){
        return $this->belongsToMany(Tenants::class,'menus_kelola', 'tenant_id', 'menu_id')->withPivot(['harga', 'gambar']);
    }
}
