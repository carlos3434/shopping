<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Shopping\CarRepository;
use App\Repositories\Shopping\CarInterface;
use App\Repositories\Shopping\UserRepository;
use App\Repositories\Shopping\UserInterface;
use App\Repositories\Shopping\OrderRepository;
use App\Repositories\Shopping\OrderInterface;

use App\Repositories\AbstractRepository;
use App\Repositories\RepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( OrderInterface::class, OrderRepository::class );
        $this->app->bind( CarInterface::class, CarRepository::class );
        $this->app->bind( UserInterface::class, UserRepository::class );
        //abstract
        $this->app->bind( RepositoryInterface::class, AbstractRepository::class );
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
