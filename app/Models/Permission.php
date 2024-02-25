<?php

namespace App\Models;

use App\Models\Konfigurrasi\Menu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends ModelsPermission
{
    use HasFactory;

    public function menu(){
        return $this->belongsToMany(Menu::class, 'menu_permission', 'permission_id', 'menu_id');
    }
}
