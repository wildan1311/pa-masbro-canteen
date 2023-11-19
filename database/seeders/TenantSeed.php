<?php

namespace Database\Seeders;

use App\Models\Menus;
use App\Models\Tenants;
use Database\Factories\MenusFactory;
use Illuminate\Database\Seeder;

class TenantSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tenants::factory(30)->hasAttached(Menus::factory(10), ['harga' => rand(10000, 15000), 'gambar' => 'halo'] , 'listMenu')->create();
    }
}
