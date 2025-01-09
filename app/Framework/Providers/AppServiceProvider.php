<?php

namespace App\Framework\Providers;

use App\Framework\Listeners\SendWelcomeEmail;
use App\Models\Post;
use App\Models\User;
use App\Posts\Application\PostsQuery;
use App\Posts\Infrastructure\DbalPostsQuery;
use App\Users\Application\UsersQuery;
use App\Users\Domain\UserRegistered;
use App\Users\Domain\UserRepository;
use App\Users\Infrastructure\DbalUserRepository;
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
            return new DbalUsersQuery(new User);
        });

        $this->app->bind(UserRepository::class, function ($app) {
            return new DbalUserRepository(new User);
        });

        $this->app->bind(PostsQuery::class, function ($app) {
            return new DbalPostsQuery(new Post);
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
