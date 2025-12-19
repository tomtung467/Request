<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    //
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
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
