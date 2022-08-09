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

    public function scopeCompanyEmployeeReport($query, $company_id, $employee_id)
    {
        return $query->with(['employee.user', 'employee.team', 'company.user', 'leaveType'])
        ->where('company_id', $company_id)
        ->where('employee_id', $employee_id);
    }

    public function scopeCompanyTeamReport($query, $company_id, $team_id)
    {
        return $query->with(['employee.user', 'employee.team', 'company.user', 'leaveType'])
        ->where('company_id', $company_id)
        ->whereHas('employee', function ($query) use ($team_id) {
            $query->where('team_id', $team_id);
        });
    }

    public function scopeEmployeeReport($query, $employee_id)
    {
        return $query->with(['leaveType'])
        ->where('employee_id', $employee_id);
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    public function scopeLastWeek($query)
    {
        return $query->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month);
    }

    public function scopeLastMonth($query)
    {
        return $query->whereBetween('created_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()]);
    }

    public function scopeLast6Month($query)
    {
        return $query->whereBetween('created_at', [now()->subMonth(6), now()]);
    }

    public function scopeThisYear($query)
    {
        return $query->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()]);
    }

    public function scopeLastYear($query)
    {
        return $query->whereDate('created_at', '>', now()->subYear());
    }

    public function scopeCustomDate($query, $date)
    {
        return $query->whereDate('created_at', $date);
    }

    public function scopeCustomRangeDate($query, $start_date, $end_date)
    {
        return $query->whereDate('created_at', '>=',$start_date)
        ->whereDate('created_at', '<=',$end_date);
    }
}


