<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Http\Request;

class Role extends EntrustRole
{
    const ROLE_ADMIN            = 1;
    const ROLE_MANAGER          = 2;
    const ROLE_CLIENT_MANAGER   = 3;

    const TYPES = [
        0 => 'INTERNAL',
        1 => 'EXTERNAL'
    ];

    protected $table = 'roles';
    protected $fillable = ['name', 'display_name', 'description', 'type'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    // Accessors
    /**
     * Accesor to convert Role type from integer to string
     *
     * @return string
     */
    public function getTypeToStringAttribute()
    {
        return self::TYPES[$this->type];
    }

    // End Accessors

    // Filters
    // public function scopeFilterByField($query, Request $request, $field_name, $db_column)
    // {
    //     return $query->when($request->has($field_name), function ($inner_query) use ($request, $db_column, $field_name) {
    //         return $inner_query->where($db_column, '=', $request->get($field_name));
    //     });
    // }

    // public function scopeFilterByNameField($query, Request $request, $field_name, $db_column)
    // {

       
    //     return $query->when($request->has($db_column), function ($inner_query) use ($request, $db_column, $field_name) {
    //         return $inner_query->where($db_column, 'LIKE', '%' . $request->get($field_name) . '%');
    //     });
    // }
    // End filters


    public function scopeFilterByNameField($query, $field, $column_name)
    {
        if (request()->has($field)) {
            return $query->where($column_name, 'LIKE', '%'.request()->get($field).'%');
        }
    }

    public function scopeFilterByField($query, $field, $column_name)
    {
        if (request()->has($field)) {
            return $query->where($column_name, '=', request()->get($field));
        }
    }
}
