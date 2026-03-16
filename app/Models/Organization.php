<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    public function staff_movement()
    {
        return $this->hasMany(StaffMovement::class, 'organization_id', 'id');
    }
}