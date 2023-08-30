<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenants extends Model
{
    use HasFactory;
    protected $table = 'tenants';

    protected $fillable = [
        'nama_tenant',
        'nama_kavling',
        'nama_gambar',
        'nama_jam',
    ];

    public function kelola(){
        // tenant dapat mengrlola banyak makanan
        // return $this->hasMany();
    }
}
