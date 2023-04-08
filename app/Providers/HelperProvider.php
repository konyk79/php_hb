<?php

namespace App\Providers;

use App\Currency;
use App\Order;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class HelperProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
//        if(Schema::hasTable('currencies')){
//            View::share('currencies', Currency::all());
//        }
//        if(Schema::hasTable('orders')){
//            View::share('orders', Order::all());
//        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path().'/Helpers/Helpers.php';
    }
}
