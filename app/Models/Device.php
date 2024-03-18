<?php

namespace App\Models;

use App\Models\Konfigurrasi\Menu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $table = 'device';
    protected $fillable = ['nama'];

    public function listMenu(){
        return $this->belongsToMany(Menu::class, 'menu_device', 'device_id', 'menu_id');
    }
}
