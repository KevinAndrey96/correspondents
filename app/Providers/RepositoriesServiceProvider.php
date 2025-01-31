<?php

namespace App\Providers;

use App\Repositories\Contracts\Permissions\PermissionRepositoryInterface;
use App\Repositories\Contracts\Products\ProductRepositoryInterface;
use App\Repositories\Contracts\Roles\RoleRepositoryInterface;
use App\Repositories\Contracts\Transactions\TransactionRepositoryInterface;
use App\Repositories\Contracts\Users\UserRepositoryInterface;
use App\Repositories\Permissions\PermissionRepository;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Roles\RoleRepository;
use App\Repositories\Transactions\TransactionRepository;
use App\Repositories\Users\UserRepository;
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
        ProductRepositoryInterface::class => ProductRepository::class,
        TransactionRepositoryInterface::class => TransactionRepository::class,
        UserRepositoryInterface::class => UserRepository::class
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
