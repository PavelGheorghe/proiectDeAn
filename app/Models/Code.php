<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    public $timestamps = true;

    protected $table = 'codes';

    protected $fillable = [
        'name',
        'per_bdx',
        'code',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    const Per_Bdx = ['Y' => '0', 'N' => '1'];

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
