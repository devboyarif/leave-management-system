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
}
