<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'thumbnail',
        'short_description',
        'long_description',
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = strSlug($value);
    }

    public function getThumbnailAttribute($thumbnail)
    {
        return $thumbnail ? asset($thumbnail) : asset('admin/img/default.png');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
