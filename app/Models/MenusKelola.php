<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenusKelola extends Model
{
    use HasFactory;

    protected $table = 'menus_kelola';

    protected $fillable = [
        'harga',
        'gambar',
        'tenant_id',
        'menu_id'
    ];

    public function menus(){
        return $this->belongsTo(Menus::class, 'menu_id');
    }
    public function tenants(){
        return $this->belongsTo(Tenants::class, 'tenant_id');
    }
}
