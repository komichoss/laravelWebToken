<?php

namespace komicho\Support;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/migrations' => 'database/migrations/',
        ]);
    }
}