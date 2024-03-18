<?php

namespace App\Providers;

use App\Models\MenusKelola;
use App\Models\Tenants;
use App\Policies\MenusKelolaPolicy;
use App\Policies\TenantsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        MenusKelola::class => MenusKelolaPolicy::class,
        // Tenants::class => TenantsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('add-tenant-menu', [MenusKelolaPolicy::class, 'create']);
        Gate::define('update-tenant-menu', [MenusKelolaPolicy::class, 'update']);
        // Gate::define('delete-tenant-menu', [MenusKelolaPolicy::class, 'delete']);

        // Gate::define('update-tenant', [MenusKelolaPolicy::class, 'update']);
        // Gate::define('delete-tenant', [MenusKelolaPolicy::class, 'delete']);
    }
}
