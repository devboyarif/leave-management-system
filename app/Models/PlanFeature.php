<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanFeature extends Model
{
    use HasFactory;

    // protected $guarded = [];

    protected $fillable = [
        'plan_id',
        'is_limited_employee',
        'max_employees',
        'max_teams',
        'max_leave_types',
        'custom_theme_look',
    ];
}
