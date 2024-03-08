<?php

namespace Database\Seeders;

use App\Models\Konfigurrasi\Menu;
use App\Models\Permission;
use App\Traits\HasMenuPermission;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    use HasMenuPermission;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $mm = Menu::firstOrCreate(['url' => 'konfigurasi'],[
        //     'name' => 'konfigurasi', 'url' => 'konfigurasi', 'category' => 'MASTER DATA',
        // ]);
        // $this->attachMenuPermission($mm, ['read'], ['admin']);

        // $sm = $mm->subMenus()->create(['name' => 'menu', 'url' => $mm->url.'/menu', 'category' => $mm->category]);
        // $this->attachMenuPermission($sm, null, ['admin']);

        $mm = Menu::firstOrCreate(['url' => '/role'],[
            'name' => 'role', 'url' => '/role', 'category' => 'KONFIGURASI',
        ]);
        $this->attachMenuPermission($mm, null, ['admin']);

        $mm = Menu::firstOrCreate(['url' => '/permission'],[
            'name' => 'permission', 'url' => '/permission', 'category' => 'KONFIGURASI',
        ]);
        $this->attachMenuPermission($mm, null, ['admin']);

        $mm = Menu::firstOrCreate(['url' => '/menu'],[
            'name' => 'menu', 'url' => '/menu', 'category' => 'KONFIGURASI',
        ]);
        $this->attachMenuPermission($mm, null, ['admin']);

        // $mm = Menu::firstOrCreate(['url' => '/makanan'],[
        //     'name' => 'Makanan', 'url' => '/makanan', 'category' => 'USER',
        // ]);
        // $this->attachMenuPermission($mm, null, ['tenant']);

        // $mm = Menu::firstOrCreate(['url' => '/katalog'],[
        //     'name' => 'katalog', 'url' => '/katalog', 'category' => 'KATALOG',
        // ]);
        // $this->attachMenuPermission($mm, ['read'], ['user']);

        // $sm = $mm->subMenus()->create(['name' => 'pesan', 'url' => $mm->url.'/pesan', 'category' => $mm->category]);
        // $this->attachMenuPermission($sm, ['read'], ['user']);

        // $ssm = $sm->subMenus()->create(['name' => 'antar', 'url' => $sm->url.'/antar', 'category' => $sm->category]);
        // $this->attachMenuPermission($ssm, ['read'], ['user']);

        // $ssm = $sm->subMenus()->create(['name' => 'ambil', 'url' => $sm->url.'/ambil', 'category' => $sm->category]);
        // $this->attachMenuPermission($ssm, ['read'], ['user']);

        // $ssm = $sm->subMenus()->create(['name' => 'transfer', 'url' => $sm->url.'/transfer', 'category' => $sm->category]);
        // $this->attachMenuPermission($ssm, ['read'], ['user']);

        // $ssm = $sm->subMenus()->create(['name' => 'cod', 'url' => $sm->url.'/cod', 'category' => $sm->category]);
        // $this->attachMenuPermission($ssm, ['read'], ['user']);
    }
}
