<?php
namespace App\Models\Traits;

use Carbon\Carbon;

trait TimeAgo
{
    public static function bootTimeAgo()
    {
        static::retrieved(function ($model) {
            $model->setAttribute('created_time_ago', self::getTimeAgo($model->created_at));
            $model->setAttribute('updated_time_ago', self::getTimeAgo($model->updated_at));
        });

        static::saving(function ($model) {
            unset($model->created_time_ago);
            unset($model->updated_time_ago);
        });
    }

    protected static function getTimeAgo($date)
    {
        if ($date->diffInDays(Carbon::now()) > 40) {
            return $date->format('Y-m-d');
        }

        return $date->diffForHumans();
    }
}
