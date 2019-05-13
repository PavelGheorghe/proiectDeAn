<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\QueryFilter;

class PolicyType extends Model
{
    protected $fillable = [
        'type',
        'note',
        'insured_type'
    ];
    /**
     * Scopes
    */

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }
}
