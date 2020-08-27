<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
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
        \App\Permission::get()->map(function ($permission){
            \Gate::define($permission->slug, function($user) use ($permission)
            {
                return $user->getPermission($permission);
            });
        });

        //Blade directives
        \Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})) :  ?>"; //return this if statement inside php tag
        });

        \Blade::directive('endrole', function ($role) {
            return "<?php endif; ?>"; //return this endif statement inside php tag
        });
    }
}
