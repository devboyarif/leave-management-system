<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyTheme extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'primary_color',
        'hover_color',
        'secondary_color',
        'success_color',
        'info_color',
        'warning_color',
        'danger_color',
    ];
}
