<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\TimeAgo;
use App\Models\Traits\FomattedTimestamps;

class Message extends Model
{
    use HasFactory;
    use TimeAgo;
    use FomattedTimestamps;

    protected $guarded = [];

    protected $casts = [
        'image' => 'json',
    ];
}
