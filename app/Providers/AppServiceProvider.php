<?php

namespace App\Providers;

use App\View\Components\Flash;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\View\Components\DashboardLayout;

class AppServiceProvider extends ServiceProvider
{
    use Flash;
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
        view()->composer('partials.messages', function ($view) {

            $messages = self::messages();
  
            return $view->with('messages', $messages);
        });

        Blade::component('dasboard-layout', DashboardLayout::class);
    }
}
