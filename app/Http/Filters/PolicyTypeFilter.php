<?php
namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class PolicyTypeFilter extends QueryFilter
{
    public function id($id)
    {
        $this->builder->where('id', $id);
    }

    public function type($type)
    {
        $this->builder->where('type', 'like', "%{$type}%");
    }

    public function note($note)
    {
        $this->builder->where('note', 'like', "%{$note}%");
    }

    public function insuredType($insured_type)
    {
        $this->builder->where('insured_type', 'like', "%{$insured_type}%");
    }
}
