<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use HasFactory;

    public function permissionis(){
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id','permission_id');
    }
}
