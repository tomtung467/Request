<?php
namespace App\Filters;

use App\Filters\BaseFilter;

class UserFilter extends BaseFilter
{
    /**
     * Filter by user name.
     *
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function FilterName($value)
    {
       return $this->builder->where('name', 'like', '%' . $value . '%');

    }
}
