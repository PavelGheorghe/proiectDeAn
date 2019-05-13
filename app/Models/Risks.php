<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Risks extends Model
{
    public $timestamps = true;

    protected $table = 'risks';

    protected $fillable = [
        'name',
        'risk_code',
        'description',
        'first_year',
        'last_year',
        'class_of_business',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function business()
    {
        return $this->belongsTo(BusinesClass::class, 'bussines_classes_id');
    }

    public function area_binders()
    {
        return $this->hasMany(AreaBinder::class);
    }

    public function scopeSearchByString($query, $field, $column_name)
    {
        if (request()->has($field)) {
            return $query->where($column_name, 'LIKE', '%'.request()->get($field).'%');
        }
    }

    public function scopeSearchByNumber($query, $field, $column_name)
    {
        if (request()->has($field)) {
            return $query->where($column_name, '=', request()->get($field));
        }
    }
}
