<?php

namespace App\Providers;

use App\UseCases\Contracts\Statistics\GetStatisticsDataUseCaseInterface;
use App\UseCases\Statistics\GetStatisticsDataUseCase;
use Illuminate\Support\ServiceProvider;

class UseCasesServiceProvider extends ServiceProvider
{
    protected array $classes = [
            GetStatisticsDataUseCaseInterface::class => GetStatisticsDataUseCase::class,
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
