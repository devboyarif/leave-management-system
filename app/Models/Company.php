<?php

namespace App\Models;

use App\Models\Country;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($company) {
            // Attach subscription to company
            $company->subscription()->create([
                'plan_id'  => 1,
                'expired_date' => now()->addMonth(),
                'subscription_type' => 'monthly'
            ]);

            // Attach working days to company
            $company->workingDays()->create([
                'monday' => true,
                'tuesday' => true,
                'wednesday' => true,
                'thursday' => true,
                'friday' => true,
                'saturday' => true,
                'sunday' => false
            ]);

            // Attach leave types to company
            $company->leaveTypes()->create([
                'name' => 'Casual Leave',
                'color' => '#00D084',
                'balance' => 14,
            ]);
            $company->leaveTypes()->create([
                'name' => 'Paid Leave',
                'color' => '#EB144C',
                'balance' => 14,
            ]);
        });
    }

    public function getCompanyLogoAttribute($logo)
    {
        if (!$logo) {
            return asset('admin/img/default-user.png');
        }

        return asset($logo);
    }

    public function teams()
    {
        return $this->hasMany(Team::class, 'company_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function leaveTypes()
    {
        return $this->hasMany(LeaveType::class, 'company_id');
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class, 'company_id');
    }

    public function holidays()
    {
        return $this->hasMany(Holiday::class, 'company_id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'company_id');
    }

    public function theme()
    {
        return $this->hasOne(CompanyTheme::class, 'company_id');
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'company_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'company_id');
    }

    public function workingDays()
    {
        return $this->hasOne(WorkingDay::class, 'company_id');
    }
}
