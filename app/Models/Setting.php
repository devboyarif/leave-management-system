<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['app_name'];

    public function getAppNameAttribute()
    {
        return config('app.name', 'Leaving');
    }

    public function getAppDarkLogoAttribute($value)
    {
        if (is_null($value)) {
            return asset('admin/img/leaving-dark.png');
        }

        return asset($value);
    }

    public function getAppLightLogoAttribute($value)
    {
        if (is_null($value)) {
            return asset('admin/img/leaving-light.png');
        }

        return asset($value);
    }

    public function getAppFaviconAttribute($value)
    {
        if (is_null($value)) {
            return asset('admin/img/favicon.png');
        }

        return asset($value);
    }
}
