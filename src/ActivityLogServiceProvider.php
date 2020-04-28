<?php

namespace Rudestewing\ActivityLogger;

use Illuminate\Support\ServiceProvider;
use Rudestewing\ActivityLogger\Commands\InstallActivityLog;

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

        // register datatables yajra
        class_alias('Yajra\DataTables\Facades\DataTables', 'DataTables');
        $this->app->register(\Yajra\DataTables\DataTablesServiceProvider::class);
        
        // routes
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
        
        //views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'activity-log');

        // if($this->app->runningInConsole()) {
        //     $this->commands([
        //         InstallActivityLog::class
        //     ]);
        // }

        $timestamp = date('Y_m_d_His', time());
        $this->publishes([
            __DIR__."/../database/migrations/create_activity_logs_table.php" => database_path("/migrations/${timestamp}_create_activity_logs_table.php")
        ], 'migrations');
    }
}
