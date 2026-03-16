<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function role_permission()
    {
        return $this->hasMany(RolePermission::class);
    }

    public function department()
    {
        return $this->hasMany(Department::class);
    }

    public function role_user()
    {
        return $this->hasMany(RoleUser::class);
    }

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }
}
