<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'username',
        'phone',
        'code',
        'email',
        'password',
        'profile',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function companies()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_users')
                    ->withPivot('is_default', 'active')
                    ->withTimestamps();
    }

    public function defaultBranch()
    {
        return $this->branches()->wherePivot('is_default', true)->first();
    }
}
