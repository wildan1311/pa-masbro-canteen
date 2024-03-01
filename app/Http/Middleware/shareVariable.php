<?php

namespace App\Http\Middleware;

use App\Models\Konfigurrasi\Menu;
use Closure;
use Illuminate\Http\Request;

class shareVariable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $menu = Menu::all();
        view()->share('menus', $menu);
        return $next($request);
    }
}
