<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\TimeAgo;
use App\Models\Traits\FomattedTimestamps;

class Customer extends Model
{
    use HasFactory;
    use TimeAgo;
    use FomattedTimestamps;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fieldParts()
    {
        return $this->hasMany(CustomerFieldPart::class);
    }

    public function certifications()
    {
        return $this->hasMany(Certificate::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('company_name', 'like', '%'.$search.'%');
                $query->orWhere('company_org_nr', 'like', '%'.$search.'%');
                $query->orWhereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%');
                    $query->orWhere('email', 'like', '%'.$search.'%');
                });
            });
        })->when($filters['role'] ?? null, function ($query, $role) {
            $query->where('role', $role);
        });
    }
}
