<?php

namespace App\Providers;

use App\Repositories\Contracts\Permissions\PermissionRepositoryInterface;
use App\Repositories\Contracts\Roles\RoleRepositoryInterface;
use App\Repositories\Permissions\PermissionRepository;
use App\Repositories\Roles\RoleRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */

    protected array $classes = [
        RoleRepositoryInterface::class => RoleRepository::class,
        PermissionRepositoryInterface::class => PermissionRepository::class,
        ];

    public function register()
    {
        foreach ($this->classes as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
