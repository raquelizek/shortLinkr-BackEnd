<?php

namespace App\Providers;

use App\Models\Access;
use App\Models\Link;
use App\Repositories\AccessRepositoryEloquent;
use App\Repositories\LinkRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\LinkRepositoryInterface', 'App\Repositories\LinkRepositoryEloquent');

        $this->app->bind('App\Repositories\LinkRepositoryInterface', function () {
            return new LinkRepositoryEloquent(new Link());
        });

        $this->app->bind('App\Repositories\AccessRepositoryInterface', 'App\Repositories\AccessRepositoryEloquent');

        $this->app->bind('App\Repositories\AccessRepositoryInterface', function () {
            return new AccessRepositoryEloquent(new Access());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
