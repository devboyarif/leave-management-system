<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $appends = ['remaining_days'];

    public function getRemainingDaysAttribute()
    {
        return formatDateTime($this->expired_date)->diffInDays(formatDateTime(now()->format('Y-m-d')));
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
