<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'leave_type_id',
        'total_days',
        'used_days',
    ];

    protected $casts = [
        'total_days' => 'integer',
        'used_days' => 'integer',
        'remaining_days' => 'integer',
    ];

    protected $appends = [
        'remaining_days',
    ];

    public function getRemainingDaysAttribute()
    {
        return $this->total_days - $this->used_days;
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }
}
