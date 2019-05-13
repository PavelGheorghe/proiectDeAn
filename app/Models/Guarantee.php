<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\QueryFilter;

class Guarantee extends Model
{
    protected $fillable = [
        'policy_type',
        'section_name',
        'guarantee_name',
    ];

    /**
     * Scopes
    */

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }
}
