<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\LeaveApplicationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Filters\LeaveApplicationFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Filterable;

class LeaveApplication extends Model
{
    //\
    use softDeletes,HasFactory,Filterable;
    protected $table = 'leave_applications';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'reason',
        'status',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'user_id' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => LeaveApplicationStatus::class,
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
