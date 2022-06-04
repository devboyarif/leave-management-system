<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'employee_id',
        'leave_type_id',
        'start',
        'end',
        'days',
        'reason',
        'status',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }
}
