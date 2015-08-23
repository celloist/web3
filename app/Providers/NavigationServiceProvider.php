<?php
/**
 * @author Alhric Lacle <alhriclacle@gmail.com>
 * @project Web3
 * @created 24-Jun-15 2:06 PM
 */


namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Guard;

class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot(Guard $auth)
    {
        // Using class based composers...
        view()->composer(
            'partials.menu', 'App\Http\ViewComposers\MenuComposer'
        );

        view()->composer('*', function ($view) use ($auth) {
            $view->with('user', $auth->user());
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}