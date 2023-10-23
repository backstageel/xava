<?php

namespace App\Providers;

use App\Models\Message;
use App\Models\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(!app()->isProduction());

//        view()->composer('layout.header', function ($view) {
//
//            $data = 'Dado que você quer compartilhar';
//            $view->with('data', $data);
//        });
    }

}
