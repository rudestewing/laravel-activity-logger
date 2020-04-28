<?php
namespace Rudestewing\ActivityLogger\Traits;

use Rudestewing\ActivityLogger\Models\ActivityLog;

trait ActivityCauser 
{
    public function actionActivityLogs()
    {
        return $this->morphMany(ActivityLog::class, 'causerable');
    }   
}