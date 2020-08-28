<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
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
        \Blade::if('env', function ($environment) {
            return app()->environment($environment);
        });

        \Blade::if('ishome', function () {
            return request()->is('/');
        }); 

        \Blade::directive('subscribed', function () {
            $condition = false;

            // check if the user is authenticated
            if (\Auth::check()) {
                // check if the user has a subscription
                $condition = \Auth::guard('guest')->user()->isSubscribed;
            }

            return "<?php if ($condition) { ?>";
        });

        \Blade::directive('unsubscribed', function () {
            return "<?php } else { ?>";
        });

        \Blade::directive('endsubscribed', function () {
            return "<?php } ?>";
        });        
    }
}
