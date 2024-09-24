<?php

namespace App\Providers;

use App\UseCases\Contracts\Roles\GetRoleIDsPermissionIDsUseCaseInterface;
use App\UseCases\Contracts\Statistics\GetStatisticsDataUseCaseInterface;
use App\UseCases\Contracts\Transactions\CreateTransactionUseCaseInterface;
use App\UseCases\Contracts\Transactions\GetTransactionDetailUseCaseInterface;
use App\UseCases\Contracts\Transactions\ValidateLimitOfTransactionsByAccountUseCaseInterface;
use App\UseCases\Roles\GetRoleIDsPermissionIDsUseCase;
use App\UseCases\Statistics\GetStatisticsDataUseCase;
use App\UseCases\Transactions\CreateTransactionUseCase;
use App\UseCases\Transactions\GetTransactionDetailUseCase;
use App\UseCases\Transactions\ValidateLimitOfTransactionsByAccountUseCase;
use Illuminate\Support\ServiceProvider;

class UseCasesServiceProvider extends ServiceProvider
{
    protected array $classes = [
            GetStatisticsDataUseCaseInterface::class => GetStatisticsDataUseCase::class,
            GetRoleIDsPermissionIDsUseCaseInterface::class => GetRoleIDsPermissionIDsUseCase::class,
            ValidateLimitOfTransactionsByAccountUseCaseInterface::class => ValidateLimitOfTransactionsByAccountUseCase::class,
            CreateTransactionUseCaseInterface::class => CreateTransactionUseCase::class,
            GetTransactionDetailUseCaseInterface::class => GetTransactionDetailUseCase::class
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
