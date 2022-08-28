<?php

namespace App\Models;

use App\Models\Team;
use App\Models\Company;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ROLE_EMPLOYEE = 'employee';
    public const ROLE_OWNER = 'owner';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatarAttribute($avatar)
    {
        if (!$avatar) {
            return asset('admin/img/default-user.png');
        }

        return asset($avatar);
    }

    public function scopeRoleAdmin()
    {
        return $this->where('role', 'admin');
    }

    public function scopeRoleOwner()
    {
        return $this->where('role', 'owner');
    }

    public function scopeRoleEmployee()
    {
        return $this->where('role', 'employee');
    }

    public function companies()
    {
        return $this->hasMany(Company::class, 'user_id');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id');
    }

    public function teams()
    {
        return $this->hasManyThrough(Team::class, Company::class);
    }

    public function holidays()
    {
        return $this->hasManyThrough(Holiday::class, Company::class);
    }
}
