<?php

namespace App\Traits;

use App\Models\Konfigurrasi\Menu;
use App\Models\Permission;

trait HasMenuPermission
{
    public function attachMenuPermission(Menu $menu, ?array $permissions, ?array $roles)
    {
        /**
         * @var Permission $permission
         */

        if (!is_array($permissions)) {
            $permissions = ['read', 'create', 'update', 'delete'];
        }

        foreach ($permissions as $value) {
            $permission = Permission::create(['name' => $value . " {$menu->nama}"]);
            $permission->menu()->attach($menu);
            if ($roles) {
                $permission->assignRole($roles);
            }
        }
    }
}
