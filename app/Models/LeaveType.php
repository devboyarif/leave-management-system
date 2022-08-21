<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'slug',
        'color',
        'auto_approve',
        'balance',
        'status',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = strSlug($value);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function leaveBalances()
    {
        return $this->hasMany(LeaveBalance::class, 'leave_type_id');
    }
}
