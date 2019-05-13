<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = true;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'piva',
        'street',
        'note',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function area_binders()
    {
        return $this->belongsToMany(AreaBinder::class)->withPivot(['company_role', 'company_quota']);
    }
    
    public function scopeSearchByString($query, $field, $column_name)
    {
        if (request()->has($field)) {
            return $query->where($column_name, 'LIKE', '%'.request()->get($field).'%');
        }
    }
}
