<?php

namespace App\Models;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
