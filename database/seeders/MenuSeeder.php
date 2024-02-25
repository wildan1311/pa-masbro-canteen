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
        $mm = Menu::firstOrCreate(['url' => 'konfigurasi'],[
            'name' => 'konfigurasi', 'url' => 'konfigurasi', 'category' => 'MASTER DATA',
        ]);
        $this->attachMenuPermission($mm, ['read'], ['admin']);

        $sm = $mm->subMenus()->create(['name' => 'menu', 'url' => $mm->url.'/menu', 'category' => $mm->category]);
        $this->attachMenuPermission($sm, null, ['admin']);
    }
}
