<?php

namespace App\Providers;

use App\Services\MovieStorage;
use Illuminate\Support\ServiceProvider;

class MovieStorageProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('moviestorage',function(){

            return new MovieStorage();
    
        });
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
