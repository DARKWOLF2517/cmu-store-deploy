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
            self::log($model, 'created');
        });

        static::updated(function (Model $model) {
            self::log($model, 'updated');
        });

        static::deleted(function (Model $model) {
            self::log($model, 'deleted');
        });

        // static::retrieved(function (Model $model) {
        //     self::log($model, 'retrieved');
        // });
    }

    protected static function log(Model $model, string $action)
    {
        Log::create([
            'model' => get_class($model),
            'action' => $action,
            'data' => json_encode($model->toArray()),
            'user' => Auth::id() ?? 'Unknown',
            'org_id' => session()->get('org_id'),
            'school_year' => session()->get('school_year'),
        ]);
    }
}
