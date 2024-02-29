<?php

namespace App\Http\Controllers\Web\Konfigurasi;

use App\DataTables\Konfigurasi\MenuDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Konfigurasi\MenuRequest;
use App\Models\Konfigurrasi\Menu;
use App\Models\Konfigurrasi\MenuPermission;
use App\Models\Permission;
use App\Models\Role;
use App\Traits\HasMenuPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MenuController extends Controller
{
    use HasMenuPermission;
    public function index()
    {
        $this->authorize('read menu');
        $menu = Menu::all();

        return view('pages.konfigurasi.menu', compact('menu'));
    }
    // public function index(MenuDataTable $menuDataTable)
    // {
    //     // Gate::authorize('read konfigurasi/menus');
    //     // $this->authorize('read konfigurasi/menu');
    //     return $menuDataTable->render('pages.konfigurasi.menu');
    // }

    public function create(Menu $menu)
    {
        $roles = Role::get();
        return view('pages.konfigurasi.tambah-menu', compact('menu', 'roles'));
    }
    // public function create(Menu $menu)
    // {
    //     return view('pages.konfigurasi.menu-form', [
    //         'action' => route('konfigurasi.menu.store'),
    //         'data' => $menu,
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Menu $menu)
    {
        $menu->name = $request->name;
        $menu->url_aplikasi = $request->url_aplikasi;
        $menu->url_server = $request->url_server;
        $menu->category = $request->category;
        $menu->icon = $request->icon;
        $menu->save();

        $this->attachMenuPermission($menu, $request->permissions ?? [], $request->roles);

        return redirect()->route('menu.index');
    }

    public function show(Menu $menu)
    {
        return view('pages.konfigurasi.lihat-permission-menu', [
            'permissions' => $menu->permissions,
            'menu' => $menu,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Konfigurrasi\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $roles = Role::get();
        return view('pages.konfigurasi.edit-menu', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Konfigurrasi\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $menu->name = $request->name;
        $menu->url_aplikasi = $request->url_aplikasi;
        $menu->url_server = $request->url_server;
        $menu->category = $request->category;
        $menu->icon = $request->icon;
        $menu->save();

        $menuPermission = MenuPermission::where('menu_id', $menu->id);
        $permissions = Permission::whereIn('id', $menuPermission->pluck('permission_id')->toArray());

        // $roles = Role::whereHas('permissions', function ($query) use ($permissions) {
        //     $query->whereIn('id', $permissions->pluck('id')->toArray());
        // })->get();

        // $roles->each(function ($role) use ($permissions) {
        //     $role->revokePermissionTo($permissions->get());
        // });

        $menuPermission->delete();
        $permissions->delete();

        if ($request->permissions) {
            foreach ($request->permissions as $value) {
                $permission = Permission::firstOrCreate(['name' => $value . " {$menu->name}"], ['name' => $value . " {$menu->name}"]);
                $permission->menu()->attach($menu);
                $permission->assignRole(['admin']);
            }
        }

        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Konfigurrasi\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menuPermission = MenuPermission::where('menu_id', $menu->id);
        $permissions = Permission::whereIn('id', $menuPermission->pluck('permission_id')->toArray());

        $roles = Role::whereHas('permissions', function ($query) use ($permissions) {
            $query->whereIn('id', $permissions->pluck('id')->toArray());
        })->get();

        $roles->each(function ($role) use ($permissions) {
            $role->revokePermissionTo($permissions->get());
        });

        $menuPermission->delete();
        $permissions->delete();
        $menu->delete();

        return redirect()->route('menu.index');
    }
}
