<?php

namespace App\Traits;

use App\Models\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait Loggable
{
    public static function bootLoggable()
    {
        static::created(function (Model $model) {
            self::log($model, 'Created');
        });

        static::updated(function (Model $model) {
            self::log($model, 'Updated');
        });

        static::deleted(function (Model $model) {
            self::log($model, 'Deleted');
        });

        // static::retrieved(function (Model $model) {
        //     self::log($model, 'retrieved');
        // });
    }

    protected static function log(Model $model, string $action)
    {
        $modelName = match (get_class($model)) {
            \App\Models\EventAttendanceChecker::class => 'Attendance Checker',

            default => class_basename($model),
        };
        Log::create([
            'model' => $modelName,
            'action' => $action,
            'data' => json_encode($model->toArray()),
            'user' => Auth::id() ?? 'Unknown',
            'org_id' => session()->get('org_id'),
            'school_year' => session()->get('school_year'),
        ]);
    }
}
