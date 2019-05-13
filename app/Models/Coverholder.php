<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coverholder extends Model
{
    public $timestamps = true;

    protected $table = 'coverholders';

    protected $fillable = [
        'name',
        'pin',
        'street',
        'note',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

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
}
