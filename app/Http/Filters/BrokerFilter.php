<?php
namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class BrokerFilter extends QueryFilter
{
    public function id($id)
    {
        $this->builder->where('id', $id);
    }

    public function type($type)
    {
        $this->builder->where('type', $type);
    }

    public function name($name)
    {
        $this->builder->where('name', 'like', "%{$name}%");
    }

    public function address($address)
    {
        $this->builder->where('address', 'like', "%{$address}%");
    }

    public function note($note)
    {
        $this->builder->where('note', 'like', "%{$note}%");
    }
}
