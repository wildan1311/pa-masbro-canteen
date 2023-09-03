<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenants extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tenants';

    protected $fillable = [
        'nama_tenant',
        'nama_kavling',
        'nama_gambar',
        'nama_jam',
    ];

    public function kelola(){
        // tenant dapat mengrlola banyak makanan
        return $this->hasMany(MenusKelola::class, 'tenant_id');
    }
    public function listMenu(){
        // tenant memiliki banyak menu
        return $this->belongsToMany(Menus::class, 'menus_kelola', 'tenant_id', 'menu_id');
    }
}
