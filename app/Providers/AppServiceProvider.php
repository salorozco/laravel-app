<?php

namespace App\Providers;

use App\Models\User;
use App\Users\Application\UsersQuery;
use App\Users\Infrastructure\DbalUsersQuery;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UsersQuery::class, function ($app) {
            return new DbalUsersQuery(new User());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
