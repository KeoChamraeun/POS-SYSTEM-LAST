<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffMovement extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}