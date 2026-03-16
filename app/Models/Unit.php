<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name',
        'short_name',
        'symbol',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}