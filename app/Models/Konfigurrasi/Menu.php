<?php

namespace App\Models\Konfigurrasi;

use App\Models\Device;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $fillable = ['nama', 'kategori', 'url', 'urutan', 'aktif', 'main_menu_id', 'ikon'];
    protected $guard = ['id'];

    public $appends = [
        'link_gambar'
    ];

    public function getLinkGambarAttribute(){
        return asset("assets/images/". $this->ikon);
    }

    public function subMenus(){
        return $this->hasMany(Menu::class, 'main_menu_id');
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'menu_permission', 'menu_id', 'permission_id');
    }

    public function device(){
        return $this->belongsToMany(Device::class, 'menu_device', 'menu_id', 'device_id');
    }
}
