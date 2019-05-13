<?php
namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class GuaranteeFilter extends QueryFilter
{
    public function id($id)
    {
        $this->builder->where('id', $id);
    }

    public function policyType($policy_type)
    {
        $this->builder->where('policy_type', 'like', "%{$policy_type}%");
    }

    public function sectionName($section_name)
    {
        $this->builder->where('section_name', 'like', "%{$section_name}%");
    }

    public function guaranteeName($guarantee_name)
    {
        $this->builder->where('guarantee_name', 'like', "%{$guarantee_name}%");
    }
}
