<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\LeaveApplicationStatus;

class LeaveRequest extends Model
{
    //\
    use softDeletes;
    protected $table = 'leave_request';
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
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => LeaveApplicationStatus::class,
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
