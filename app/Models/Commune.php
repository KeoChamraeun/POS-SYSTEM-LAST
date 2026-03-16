<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;
    public function district()
    {
        return $this->hasOne(District::class);
    }
    public function village()
    {
        return $this->hasMany(Village::class);
    }
}
