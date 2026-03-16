<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'phone',
        'email',
        'address',
        'status',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
}