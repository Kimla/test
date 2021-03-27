<?php
namespace App\Models\Traits;

use Carbon\Carbon;

trait FomattedTimestamps
{
    public static function bootFomattedTimestamps()
    {
        static::retrieved(function ($model) {
            $model->setAttribute('formatted_timestamps', [
                'created' => $model->created_at->format('Y-m-d H:i'),
                'updated' => $model->updated_at->format('Y-m-d H:i')
            ]);
        });

        static::saving(function ($model) {
            unset($model->formatted_timestamps);
        });
    }
}
