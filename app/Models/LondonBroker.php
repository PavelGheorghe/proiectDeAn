<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LondonBroker extends Model
{
    protected $fillable = ['reference_number', 'name', 'address', 'note'];

    // Relations
    public function area_binders()
    {
        return $this->hasMany(AreaBinder::class);
    }
    // End relations

    // Filters
    public function scopeFilterByField($query, Request $request, $field_name, $db_column)
    {
        return $query->when($request->has($field_name), function ($inner_query) use ($request, $db_column, $field_name) {
            return $inner_query->where($db_column, '=', $request->get($field_name));
        });
    }

    public function scopeFilterByNameField($query, Request $request, $field_name, $db_column)
    {
        return $query->when($request->has($field_name), function ($inner_query) use ($request, $db_column, $field_name) {
            return $inner_query->where($db_column, 'LIKE', '%' . $request->get($field_name) . '%');
        });
    }
    // End filters
}
