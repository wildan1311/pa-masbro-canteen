<?php

namespace App\Policies;

use App\Models\Menus;
use App\Models\MenusKelola;
use App\Models\Tenants;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MenusKelolaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MenusKelola  $menusKelola
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, MenusKelola $menusKelola)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, Tenants $tenant)
    {
        return $user->id === $tenant->user_id
                ? Response::allow()
                : Response::deny('Anda bukan pemilik tenant ini');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MenusKelola  $menusKelola
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Menus $menusKelola, Tenants $tenants)
    {
        return $tenants->id === $menusKelola->tenant_id && $tenants->user_id === $user->id
                ? Response::allow()
                : Response::deny('Anda bukan pemilik tenant ini');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MenusKelola  $menusKelola
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, MenusKelola $menusKelola, Tenants $tenants)
    {
        return $tenants->id === $menusKelola->tenant_id && $tenants->user_id === $user->id
                ? Response::allow()
                : Response::deny('Anda bukan pemilik tenant ini');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MenusKelola  $menusKelola
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, MenusKelola $menusKelola)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MenusKelola  $menusKelola
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, MenusKelola $menusKelola, Tenants $tenants)
    {
        return $tenants->id === $menusKelola->tenant_id && $tenants->user_id === $user->id
                ? Response::allow()
                : Response::deny('Anda bukan pemilik tenant ini');
    }
}
