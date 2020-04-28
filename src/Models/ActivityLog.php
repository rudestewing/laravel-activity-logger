<?php
namespace Rudestewing\ActivityLogger\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ActivityLog extends Model
{
    protected $guarded = [];

    public $incrementing = false;

    protected $cast = [
        'id' => 'string',
        'before' => 'json',
        'after' => 'json'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->{$model->getKeyName()} = self::generateUUID();
        });
    }

    private static function generateUUID()
    {
        $uuid = (string) Str::uuid().time();

        return $uuid;
    }

    public function causer()
    {

    }

    public function subjectable()
    {
        return $this->morphTo();
    }

    public function causerable()
    {
        return $this->morphTo();
    }
}