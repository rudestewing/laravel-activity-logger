<?php
namespace Rudestewing\ActivityLogger\Traits;

use Rudestewing\ActivityLogger\Models\ActivityLog;

trait ActivityLogger
{
    public static function boot()
    {
        parent::boot();

        static::updating(function($model) {
            $model->excuteLog('update');
        });

        static::created(function($model) {
           $model->excuteLog('create');
        });
    }

    private function excuteLog($action = null)
    {
        $diff = $this->getDiff();

        $authCauser = $this->identifyCauser();

        $this->subjectActivityLogs()->create([
            'causerable_id' => $this->getCauserKey($authCauser),
            'causerable_type' => $this->getCauserType($authCauser),
            'before' => $diff['before'],
            'after' => $diff['after'],
            'action' => $action
        ]);
    }

    private function getDiff()
    {
        $changed = $this->getDirty();
        $fresh = $this->fresh() ? $this->fresh()->toArray() : [];

        $before = (array_intersect_key($fresh, $changed));
        $after  = ($changed);

        return compact('before', 'after');
    }


    private function identifyCauser()
    {
        return auth();
    }

    private function getCauserKey($authCauser = null)
    {
        if($authCauser == null) {
            return null;
        }
        
    }

    private function getCauserType($authCauser = null)
    {
        if($authCauser == null) {
            return null;
        }
        
    }

    // relations
    public function subjectActivityLogs()
    {
        return $this->morphMany(ActivityLog::class, 'subjectable');
    }

}