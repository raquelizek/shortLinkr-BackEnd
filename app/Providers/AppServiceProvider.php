<?php

namespace App\Providers;

use App\Models\Link;
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
