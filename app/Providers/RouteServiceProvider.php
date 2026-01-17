<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadRoutesFrom(base_path('routes/frontend.php'));
        $this->loadRoutesFrom(base_path('routes/backend.php'));
    }
}
