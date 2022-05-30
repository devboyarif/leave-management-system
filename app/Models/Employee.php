<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'team_id',
    ];

    public function company(){
        return $this->belongsTo(Company::class,'company_id');
    }

    public function team(){
        return $this->belongsTo(Team::class,'team_id');
    }
}
