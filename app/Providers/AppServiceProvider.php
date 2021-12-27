<?php

namespace App\Providers;
use Auth;
use Blade;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // custom blade for role check

        Blade::if('role', function ($role)
        {
           return Auth::user()->role->slug == $role;
        });
    }
}
