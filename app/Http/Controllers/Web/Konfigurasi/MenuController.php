<?php

namespace App\Http\Controllers\Web\Konfigurasi;

use App\DataTables\Konfigurasi\MenuDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Konfigurasi\MenuRequest;
use App\Models\Device;
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
        $devices = Device::all();
        return view('pages.konfigurasi.tambah-menu', compact('menu', 'roles', 'devices'));
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
        $menu->nama = $request->name;
        $menu->url = $request->url;
        // $menu->url_server = $request->url_server;
        $menu->kategori = $request->category;
        $menu->ikon = $request->icon;
        $menu->save();

        $menu->device()->sync($request->device_id);
        // $device = Device::find($request->device_id);
        // $device->listMenu()->attach($menu);

        $this->attachMenuPermission($menu, $request->permissions ?? [], []);

        return redirect()->route('menu.index')->with(["status" => "success", 'message' => "Menu berhasil ditambahkan"]);
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
        $devices = Device::all();
        return view('pages.konfigurasi.edit-menu', compact('menu', 'devices'));
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
        $menuPermission = MenuPermission::where('menu_id', $menu->id);
        $permissions = Permission::whereIn('id', $menuPermission->pluck('permission_id')->toArray());
        $roles = (Role::whereHas('permissions', function($permissionis)  use ($permissions){
            $permissionis->whereIn('id', $permissions->pluck('id')->toArray());
        })->get());

        if ($menu->name != $request->nama) {
            $menuPermission->delete();
            $permissions->delete();
        }

        $menu->nama = $request->name;
        $menu->url = $request->url;
        $menu->kategori = $request->category;
        $menu->ikon = $request->icon;
        $menu->save();

        $menu->device()->sync($request->device_id);
        $permissions = [];
        foreach ($request->permissions ?? [] as $value) {
            $permission = Permission::firstOrCreate(['name' => $value . " {$menu->nama}"], ['name' => $value . " {$menu->nama}"]);
            // $permission->syncRoles();
            $permissions[] = $permission->id;
        }

        $sync = ($menu->permissions()->sync($permissions));
        $this->syncRolePermission($roles, $sync);
        // $permission = Permission::whereIn("id", $detached);

        return redirect()->route('menu.index')->with(["status" => "success", 'message' => "Menu berhasil diupdate"]);
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

        return redirect()->route('menu.index')->with(["status" => "success", 'message' => "Menu berhasil dihapus"]);
        ;
    }

    public function syncRolePermission($roles, $sync){
        foreach($roles ?? [] as $role){
            $role->permissions()->attach($sync["attached"]);
            $role->permissions()->detach($sync["detached"]);
        }
        Permission::whereIn('id', $sync['detached'])->delete();
    }
}
