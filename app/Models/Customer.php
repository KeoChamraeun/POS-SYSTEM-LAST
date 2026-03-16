<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'code',
        'name',
        'phone',
        'email',
        'address',
        'gender',
        'dob',
        'note',
        'status',
    ];

    protected $casts = [
        'dob'    => 'date',
        'status' => 'boolean',
    ];

    public static function generateCode(): string
    {
        $prefix = 'CUST-';
        $last = self::latest('id')->first();

        if (!$last) {
            return $prefix . '0001';
        }

        $number = (int) substr($last->code, strlen($prefix));
        return $prefix . str_pad($number + 1, 4, '0', STR_PAD_LEFT);
    }
}