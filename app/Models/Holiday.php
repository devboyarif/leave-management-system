<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Holiday extends Model
{
    use HasFactory, BelongsToThrough;

    protected $fillable = [
        'company_id',
        'title',
        'start',
        'end',
        'color',
        'days'
    ];

    public function user()
    {
        return $this->belongsToThrough(User::class, Company::class);
    }
}
