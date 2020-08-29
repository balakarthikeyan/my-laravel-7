<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Helpers;

class HelperServicerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->loadHelpers();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadHelpers();
    }

    protected function loadHelpers()
    {
        $this->app->bind('helpers',function(){
            return new Helpers();    
        });        
    }    
}
