<?php

namespace Rudestewing\ActivityLogger\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallActivityLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activity-log:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('vendor:publish', [
            '--provider' => "Rudestewing\ActivityLog\ActivityLogServiceProvider",
            '--tag' => 'migrations'
        ]);
    }
}
