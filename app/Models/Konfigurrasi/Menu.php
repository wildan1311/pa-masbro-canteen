<?php

namespace App\Models\Konfigurrasi;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $guard = ['id'];

    public function subMenus(){
        return $this->hasMany(Menu::class, 'main_menu_id');
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'menu_permission', 'menu_id', 'permission_id');
    }
}
