<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\TimeAgo;
use App\Models\Traits\FomattedTimestamps;

class CustomerFieldPart extends Model
{
    use HasFactory;
    use TimeAgo;
    use FomattedTimestamps;

    protected $guarded = [];

    protected $casts = [
        'map_image' => 'json',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
