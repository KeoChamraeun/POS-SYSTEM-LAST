<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "cities";
    use HasFactory;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function district()
    {
        return $this->hasMany(District::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'id', 'city_id');
    }
}
