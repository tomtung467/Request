<?php
namespace App\Filters;
use App\Filters\BaseFilter;
use App\Enums\LeaveApplicationStatus;
use App\Models\LeaveApplication;
use Illuminate\Http\Request;

class LeaveApplicationFilter extends BaseFilter
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
    /**
     * Filter by leave application status.
     *
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected $filterable = [
        'status',
        'user_id',
    ];
      public function filterName($name)
    {
        return $this->builder->where('name', 'like', '%' . $name . '%');
    }
    public function filterMonth($month)
    {
        return $this->builder->whereMonth('start_date', $month);
    }
    public function filterYear($year)
    {
        return $this->builder->whereYear('start_date', $year);
    }
}
