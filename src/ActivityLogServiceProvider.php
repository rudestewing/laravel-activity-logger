<?php

namespace Rudestewing\ActivityLogger;

use Illuminate\Support\ServiceProvider;

class ActivityLogServiceProvider extends ServiceProvider
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
        class_alias('Yajra\DataTables\Facades\DataTables', 'DataTables');
        $this->app->register(\Yajra\DataTables\DataTablesServiceProvider::class);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/views', 'activity-log');
    }
}
