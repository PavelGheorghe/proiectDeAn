<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    /**
     * @var Request
     *
     */
    protected $request;
    /**
     * $builder
     *
     * @var Builder
     */
    protected $builder;

    /**
     *
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     *
     * @param Builder $builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->fields() as $field => $value) {
            $method = camel_case($field);
            if (method_exists($this, $method)) {
                call_user_func_array([$this, $method], (array)$value);
            }
        }
    }

    /**
     *
     * @return array
     */
    protected function fields()
    {
        return array_filter($this->request->all(), array($this, 'sanitize'));
    }

    /**
     * Remove fields that are empty, false but not those which are 0
     *
     * @param mixed $var
     * @return void
     */
    protected function sanitize($var)
    {
        return ($var !== null && $var !== false && $var !== '');
    }
}
