<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Auth;
use App\Repository\User;
use App\Repository\Todo;

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
        // Auth Repository Bind
        $this->app->bind(Auth\AuthRepositoryInterface::class, Auth\AuthRepository::class);

        // User Repository Bind
        $this->app->bind(User\UserRepositoryInterface::class, User\UserRepository::class);

        // Todo Repository Bind
        $this->app->bind(Todo\TodoRepositoryInterface::class, Todo\TodoRepository::class);
    }
}
