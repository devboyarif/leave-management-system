<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'price',
        'interval',
        'status',
        'recommended',
        'default',
    ];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = strSlug($name);
    }

    public function planFeatures()
    {
        return $this->hasOne(PlanFeature::class, 'plan_id');
    }
}
