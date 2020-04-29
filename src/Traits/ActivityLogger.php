<?php
namespace Rudestewing\ActivityLogger\Traits;

use Illuminate\Auth\AuthManager;
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
            'before' => json_encode($diff['before']),
            'after' => json_encode($diff['after']),
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


    private function identifyCauser(): AuthManager
    {
        // $guard = auth()->guard(); // Retrieve the guard
        // $sessionName = $guard->getName(); // Retrieve the session name for the guard
        
        // // The following extracts the name of the guard by disposing of the first
        // // and last sections delimited by "_"
        // $parts = explode("_", $sessionName);
        // unset($parts[count($parts)-1]);
        // unset($parts[0]);
        // $guardName = implode("_",$parts);

        $auth = auth();

        if($auth) {
            return auth();
        }

        return null;
    }

    private function getCauserKey($authCauser = null)
    {
        if($authCauser == null) {
            return null;
        }

        $model = $authCauser->user();
        return ($model->{$model->getKeyName()});
    }

    private function getCauserType($authCauser = null)
    {
        if($authCauser == null) {
            return null;
        }

        return $authCauser->guard()->getProvider()->getModel();
    }


    // relations
    public function subjectActivityLogs()
    {
        return $this->morphMany(ActivityLog::class, 'subjectable');
    }

}