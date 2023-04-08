<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ZoomServiceProvider extends ServiceProvider
{
    public function boot()
    {
//        $this->publishes([
//            __DIR__.'../../config/zoom.php' => config_path('zoom.php'),
//        ], 'translatable');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/zoom.php', 'zoom'
        );
    }
}
