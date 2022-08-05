<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['remaining_days', 'plan_expired'];

    public function getRemainingDaysAttribute()
    {
        if ($this->subscription_type == 'lifetime') {
            return 'Lifetime';
        } else {
            return formatDateTime($this->expired_date)->diffInDays(formatDateTime(now()->format('Y-m-d')));
        }
    }

    public function getPlanExpiredAttribute()
    {
        if ($this->subscription_type == 'lifetime') {
            return false;
        } else {
            return formatDateTime($this->expired_date)->isFuture() ? false : true;
        }
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
