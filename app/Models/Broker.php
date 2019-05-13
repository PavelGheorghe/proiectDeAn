<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\QueryFilter;

class Broker extends Model
{
    const TYPE_BROKER    = 0;
    const TYPE_PRODUCER  = 1;

    protected $fillable = [
        'type',
        'name',
        'address',
        'note'
    ];
    /**
     * Constant related operations
     */
    public static function getTypesConstants()
    {
        return [
            self::TYPE_BROKER,
            self::TYPE_PRODUCER
        ];
    }
    public static function getMainsToString()
    {
        return [
            self::TYPE_BROKER   => 'Broker',
            self::TYPE_PRODUCER => 'Producer'
        ];
    }

    /**
     * Model Accessors
    */

    public function getTypeToStringAttribute()
    {
        return self::getMainsToString()[$this->type];
    }

    /**
     *  Scopes
    */

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }
}
