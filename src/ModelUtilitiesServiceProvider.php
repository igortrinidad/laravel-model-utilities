<?php

namespace IgorTrinidad\ModelUtilities;

use Illuminate\Support\ServiceProvider;

class ModelUtilitiesServiceProvider extends ServiceProvider {

    /**
    * boot
    */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/model-utilities.php' => config_path('model-utilities.php'),
        ]);
    }

    /**
    * register
    */
    public function register()
    {

    }

}
