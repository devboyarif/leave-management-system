<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['app_name'];

//     app_dark_logo
// app_light_logo
// app_favicon
// $table->string('app_dark_logo')->default('admin/img/leaving-dark.png');
// $table->string('app_light_logo')->default('admin/img/leaving-light.png');
// $table->string('app_favicon')->default('admin/img/favicon.png');
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
