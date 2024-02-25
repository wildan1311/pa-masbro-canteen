<?php

namespace Database\Seeders;

use App\Models\Konfigurrasi\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mm = Menu::create([
            'name' => 'konfigurasi', 'url' => 'konfigurasi', 'category' => 'MASTER DATA',
        ]);

        $mm->subMenus()->create(['name' => 'menu', 'url' => $mm->url.'/menu', 'category' => $mm->category]);
    }
}
