<?php

namespace App\Providers;

use App\Models\Konfigurrasi\Menu;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $menu = Menu::all();
        // view()->share('menus', $menu);
    }
}
