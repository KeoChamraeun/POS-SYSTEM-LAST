<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function commune()
    {
        return $this->hasMany(Commune::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
