<?php
namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class BaseFilter
{
    protected $request;
    protected $builder;

    /**
     * Apply filters to the query builder.
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        $this->request = request();

        foreach ($this->filters() as $filter => $value) {
            if (method_exists($this, $filter) && $value !== null) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    /**
     * Get filters from request.
     */
    protected function filters()
    {
        return $this->request->all();
    }
}
