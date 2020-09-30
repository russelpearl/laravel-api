<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// add
use App\Repositories\AuthRepository;
use App\Interfaces\AuthRepositoryInterface;

use App\Repositories\CEORepository;
use App\Interfaces\CEORepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(CEORepositoryInterface::class, CEORepository::class);
    }
}
