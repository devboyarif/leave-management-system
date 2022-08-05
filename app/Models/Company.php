<?php

namespace App\Models;

use App\Models\Country;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country_id'
    ];

    protected static function booted()
    {
        static::created(function ($company) {
            $company->subscription()->create([
                'plan_id'  => 1,
                'expired_date' => now()->addMonth(),
                'subscription_type' => 'monthly'
            ]);
            $company->subscriptionHistory()->create([
                'plan_id'  => 1,
            ]);
        });
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

    public function subscriptionHistory()
    {
        return $this->hasMany(SubscriptionHistory::class, 'company_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'company_id');
    }
}
