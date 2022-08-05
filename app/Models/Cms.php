<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getAboutImageAttribute($value)
    {
        if (is_null($value)) {
            return asset('website/images/about/about-image.svg');
        }

        return asset($value);
    }
}
