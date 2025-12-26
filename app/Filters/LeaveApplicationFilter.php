<?php
namespace App\Filters;
use App\Filters\BaseFilter;
use App\Enums\LeaveApplicationStatus;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveApplicationFilter extends BaseFilter
{
    public function __construct(Request $request)
    {
        $this->request = $request;
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
        'month',
        'year',
    ];
      public function filterName($name)
    {
        return $this->builder->where('name', 'like', '%' . $name . '%');
    }
}
