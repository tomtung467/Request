<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\BaseFilter;

trait Filterable
{
    //
 public function scopeFilter(Builder $builder, BaseFilter $filters, array $filterFields = ['*'], array $orderFields = [])
    {
        return $filters->apply($builder, $filterFields, $orderFields);
    }
}
