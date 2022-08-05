<?php

namespace App\Models;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Znck\Eloquent\Traits\BelongsToThrough;

class Team extends Model
{
    use HasFactory, BelongsToThrough;

    protected $fillable = [
        'company_id',
        'name',
        'slug',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = strSlug($value);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function users()
    {
        return $this->belongsToThrough(User::class, Company::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'team_id');
    }
}
