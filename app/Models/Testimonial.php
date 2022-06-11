<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'avatar',
        'description',
        'stars',
    ];

    public function getAvatarAttribute($avatar)
    {
        return $avatar ? asset($avatar) : asset('admin/img/default-user.png');
    }
}
