<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'primary_color',
        'hover_color',
        'secondary_color',
        'success_color',
        'info_color',
        'warning_color',
        'danger_color',
        'website_primary_color',
        'website_secondary_color',
        'website_heading_text_color',
        'website_body_text_color',
    ];
}
